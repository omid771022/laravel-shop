<?php

namespace App\Helper\Cart;

use session;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class CartService
{

    protected $cart;
    public function __construct()
    {
        $this->cart = session()->get('cart') ?? collect([]);
    }
    public function put($value, $obj = null)
    {
        if (!is_null($obj) && $obj instanceof Model) {
            $value = array_merge($value, [
                'id' => Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj)
            ]);
        }

        $this->cart->put($value['id'], $value);
        session()->put('cart', $this->cart);
        return $this;
    }

    public function has($key)
    {
        if ($key instanceof Model) {
            return !is_null(
                $this->cart->where('subject_id', $key->id)->where('subject_type', get_class($key))->first()
            );
        }
        return !is_null($this->cart->where('id', $key)->first());
    }


    public function get($key)
    {
        $item = $key instanceof model;
        if ($item) {
            $model = $this->cart->where('subject_id', $key->id)->where('subject_type', get_class($key))->first();
            return $this->relationCourse($model);
        } else {
            $model = $this->cart->where('id', $key)->first();
            return $this->relationCourse($model);
        }
    }

    public function all()
    {
        $cart = $this->cart;
        $cart = $cart->map(function ($model) {
            return $this->relationCourse($model);
        });

        return $cart;
    }
    protected function relationCourse($model)
    {
        if (isset($model['subject_type']) &&  isset($model['subject_id'])) {
            $class = $model['subject_type'];
            $subject = (new $class())->find($model['subject_id']);
            $model[class_basename($class)] = $subject;
            return $model;
        }
        return $model;
    }

    public function delete($course)
    {

        if ($this->has($course)) {
            $this->cart = $this->cart->filter(function ($item) use ($course) {
                if ($course instanceof Model) {
                    return ($item['subject_id'] != $course->id) && ($item['subject_type'] != get_class($course));
                }
                return $course != $item['id'];
            });
            session()->put('cart', $this->cart);
            return true;
        }
        return false;
    }
}
