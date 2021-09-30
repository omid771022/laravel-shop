<?php
function newFeedback( $body, $type){
    $session = session()->has('feedbacks') ? session()->get('feedbacks') : [];
    $session[] = [ "body"=>  $body];
    session()->flash('feedbacks', $session);
}