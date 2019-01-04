<?php

/* @var $this yii\web\View */


foreach($posts as $post){
echo '
    <div>
    <h2>'.$post->title.'</h2>
    <p>'.substr($post->body,0,300).'...</p>
    <p><small>Posted by '.$post->user->username.' at '.date('F j, Y, g:i a',strtotime($post->created_at)).'</small></p>
    </div>';
}
?>