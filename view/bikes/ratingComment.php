<?php
/**
 * Created by PhpStorm.
 * User: hansb
 * Date: 20/05/2017
 * Time: 20:37
 */

namespace bikes;

require_once(VIEW_PATH . "/view.php");

use View;

class RatingComment implements View {

    /**
     * @var int
     */
    private $rating;

    function __construct($rating) {
        $this->rating = $rating;
    }

    function render() {
        echo "<p>You have rated $this->rating starts, would you like to comment? </p>";
        echo "
<form action='' method='post'>
    <input type='hidden' name='form-id' value='rating-comment'>
    <textarea class='form-control' name='comment' placeholder='What would you like to say?'></textarea>
    <input type='submit' class='btn btn-success pull-right' value='Submit'>
</form>";
    }
}