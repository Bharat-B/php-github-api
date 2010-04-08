<?php

require_once(dirname(__FILE__).'/phpGitHubApiAbstract.php');

/**
 * Searching users, getting user information and managing authenticated user account information.
 * http://develop.github.com/p/users.html
 *
 * @author    Thibault Duplessis <thibault.duplessis at gmail dot com>
 * @license   MIT License
 */
class phpGitHubApiUser extends phpGitHubApiAbstract
{
  /**
   * Search users by username
   * http://develop.github.com/p/users.html#searching_for_users
   *
   * @param   string  $username         the username to search
   * @return  array                     list of users found
   */
  public function search($username)
  {
    $response = $this->api->get('user/search/'.$username);

    return $response['users'];
  }

  /**
   * Get extended information about a user by its username
   * http://develop.github.com/p/users.html#getting_user_information
   *
   * @param   string  $username         the username to show
   * @return  array                     informations about the user
   */
  public function show($username)
  {
    $response = $this->api->get('user/show/'.$username);

    return $response['user'];
  }

  /**
   * Update user informations. Requires authentication.
   * http://develop.github.com/p/users.html#authenticated_user_management
   *
   * @param   string  $username         the username to update
   * @param   array   $data             key=>value user attributes to update.
   *                                    key can be name, email, blog, company or location
   * @return  array                     informations about the user
   */
  public function update($username, array $data)
  {
    $response = $this->api->post('user/show/'.$username, array('values' => $data));

    return $response['user'];
  }

  /**
   * Request the users that a specific user is following
   * http://develop.github.com/p/users.html#following_network
   *
   * @param   string  $username         the username
   * @return  array                     list of followed users
   */
  public function getFollowing($username)
  {
    $response = $this->api->get('user/show/'.$username.'/following');

    return $response['users'];
  }

  /**
   * Request the users following a specific user
   * http://develop.github.com/p/users.html#following_network
   *
   * @param   string  $username         the username
   * @return  array                     list of following users
   */
  public function getFollowers($username)
  {
    $response = $this->api->get('user/show/'.$username.'/followers');

    return $response['users'];
  }

  /**
   * Make the authenticated user follow the specified user. Requires authentication.
   * http://develop.github.com/p/users.html#following_network
   *
   * @param   string  $username         the username to follow
   * @return  array                     list of followed users
   */
  public function follow($username)
  {
    $response = $this->api->post('user/follow/'.$username);

    return $response['users'];
  }

  /**
   * Make the authenticated user unfollow the specified user. Requires authentication.
   * http://develop.github.com/p/users.html#following_network
   *
   * @param   string  $username         the username to unfollow
   * @return  array                     list of followed users
   */
  public function unFollow($username)
  {
    $response = $this->api->post('user/unfollow/'.$username);

    return $response['users'];
  }

  /**
   * Request the repos that a specific user is watching
   * http://develop.github.com/p/users.html#watched_repos
   *
   * @param   string  $username         the username
   * @return  array                     list of watched repos
   */
  public function getWatchedRepos($username)
  {
    $response = $this->api->get('repos/watched/'.$username);

    return $response['repositories'];
  }
}