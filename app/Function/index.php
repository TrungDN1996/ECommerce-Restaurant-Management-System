<?php

use Lava\Model\Category;
use Lava\Model\Post;
use Lava\Model\User;

require_once 'function_storage.php';

/**
 * get all categories sortby level
 *
 * @return array
 */
function get_cate()
{
    $categories = Category::whereNull('parent_id')->get()->toArray();
    foreach($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories[$key]["child"] = get_child_cate($category["id"]);
    }
    return $categories;
}

/**
 * get all child categories of specific category
 * sort by level
 *
 * @param  $id INT
 * @return array
 */
function get_child_cate($id)
{
    $categories = Category::where('parent_id', $id)->get()->toArray();
    foreach($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories[$key]["child"] = get_child_cate($category["id"]);
    }
    return $categories;
}

/**
 * get all child categories of a specific categories
 * don't sort. just a simple array of children id
 *
 * @param  [type] $id [description]
 * @return array
 */
function get_all_child_cate($id)
{
    $categories = Category::where('parent_id', $id)->get()->toArray();
    foreach ($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories = array_merge($categories, get_all_child_cate($category["id"]));
    }
    return $categories;
}

/**
* Check if the current categoriy has child categories
*
* @param  [type]  $id [description]
* @return boolean     [description]
*/
function is_parent_cate($id)
{
    $category = Category::where('parent_id', $id)->get()->toArray();
    if (empty($category))
    return false;
    return true;
}

/**
 * Show list of categories in option html tag
 *
 * @param  array $categories
 * @param  integer $i          [description]
 * @return string
 */
function option_list_cate($categories ,$i = 0)
{
    $option = '';
    foreach ($categories as $key => $category)
    {
        $option = $option.'<option class="level-'.$i.'" value="'.$category["id"].'">'.$category["name"].'</option>';
        if (is_parent_cate($category["id"])) {
            $j = $i;
            $j++;
            $option = $option.option_list_cate(get_child_cate($category["id"]), $j);
        }
    }
    return $option;
}

/**
 * get all post of specific category
 * and its children categories
 */
function get_post_in_cate($id)
{
    $posts = Post::where('category_id', $id);
    if (is_parent_cate($id)) {
        $child_cates = get_all_child_cate($id);
        foreach ($child_cates as $key => $category) {
            $posts = $posts->orWhere('category_id', $category["id"]);
        }
    }
    return $posts;
}

/**
 * category: type = post
 */
function get_cate_post()
{
    $categories = Category::where('type', 'post')->whereNull('parent_id')->get()->toArray();
    foreach($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories[$key]["child"] = get_child_cate($category["id"]);
    }
    return $categories;
}

/**
 * category: type = post_product
 */
function get_cate_post_product()
{
    $categories = Category::where('type', 'post_product')->whereNull('parent_id')->get()->toArray();
    foreach($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories[$key]["child"] = get_child_cate($category["id"]);
    }
    return $categories;
}

/**
 * category: type = post_product
 */
function get_cate_product()
{
    $categories = Category::where('type', 'product')->whereNull('parent_id')->get()->toArray();
    foreach($categories as $key => $category)
    {
        if (is_parent_cate($category["id"]))
            $categories[$key]["child"] = get_child_cate($category["id"]);
    }
    return $categories;
}

/**
 * get all user with role=admin
 *
 * @return string list option of author.
 */
function get_author_option_list($id)
{
    $users = User::where('role', 'admin')->get();
    $author = '';
    foreach ($users as $user) {
        if ($user->id == $id)
            $author = $author.'<option value="'.$user->id.'" selected>'.$user->name.'</option>';
        else
            $author = $author.'<option value="'.$user->id.'">'.$user->name.'</option>';
    }
    return $author;
}

/**
 * [category_parent description]
 *
 * @return [type]            [description]
 */
 function category_parent ($datas, $parent = 0, $str="--", $selected = 0)
 {
     foreach ($datas as $value) {
         $id = $value["id"];
         $name = $value["name"];
         if ($value["parent_id"] == $parent) {
             if ($selected != 0 && $id == $selected) {
                 echo "<option value='$id' selected = 'selected'>$str $name</option>";
             } else {
                 echo "<option value='$id'>$str $name</option>";
             }
             category_parent ($datas, $id, $str."--", $selected);
         }
     }
 }
