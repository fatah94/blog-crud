<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

foreach($posts as $post){
echo '
    <div>
    <h2>'.$post->title.'</h2>
    <p>'.substr($post->content,0,300).'...</p>
    <p><small>Posted by '.$post->username.' at '.date('F j, Y, g:i a',strtotime($post->date)).'</small></p>
    </div>';
}
?>