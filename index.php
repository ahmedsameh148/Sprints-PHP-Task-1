<?php require_once('layout/header.php'); ?>
  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        <div class="item">
          <img src="assets/images/banner-item-01.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html">
                <h4>Morbi dapibus condimentum</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 12, 2020</a></li>
                <li><a href="#">12 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-02.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html">
                <h4>Donec porttitor augue at velit</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 14, 2020</a></li>
                <li><a href="#">24 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-03.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html">
                <h4>Best HTML Templates on TemplateMo</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 16, 2020</a></li>
                <li><a href="#">36 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-04.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html">
                <h4>Responsive and Mobile Ready Layouts</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 18, 2020</a></li>
                <li><a href="#">48 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-05.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html">
                <h4>Cras congue sed augue id ullamcorper</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 24, 2020</a></li>
                <li><a href="#">64 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-06.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html">
                <h4>Suspendisse nec aliquet ligula</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 26, 2020</a></li>
                <li><a href="#">72 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <section class="blog-posts">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              <!-- Task Starts Here -->
              <?php
                  $conn = mysqli_connect('localhost', 'root', '', 'blog');
                  if ($conn) {
                    $SQL = "SELECT posts.id, posts.title, posts.content, posts.publish_date, categories.name as cat_name, users.type, users.name FROM posts 
                            INNER JOIN categories 
                              ON posts.category_id = categories.id 
                            INNER JOIN users
                              ON posts.user_id = users.id
                            ORDER BY publish_date DESC limit 4;";
                    $query = mysqli_query($conn, $SQL);
                    $success = false;
                    while (($row = mysqli_fetch_assoc($query)) != null) {
                      $row['type'] = ($row['type'] == 0) ? 'Admin - ' . $row['name'] : $row['name'];
                      $commentsQuery = mysqli_query($conn, "SELECT COUNT(*) as comments_count FROM comments WHERE post_id = ".$row['id']." ;");
                      $comments_number = mysqli_fetch_assoc($commentsQuery)['comments_count'];
                      
                      $tagsQuery = mysqli_query($conn, "SELECT tags.name FROM post_tags 
                                                        INNER JOIN tags 
                                                          ON post_tags.tag_id = tags.id
                                                        WHERE post_tags.post_id = ".$row['id']." ;"
                                                  );
                      $tagsHTML = '';
                      while (($tagRow = mysqli_fetch_assoc($tagsQuery)) != null) {
                        $tagsHTML .= "<li><a href='#'>".$tagRow['name']."</a>, </li>";
                      }
                      if($tagsHTML == '')
                        $tagsHTML = "<li><a href='#'>NO Tags Found ^_^</a> , </li>";
                      echo "
                        <div class='col-lg-12'>
                        <div class='blog-post'>
                          <div class='blog-thumb'>
                            <img src='assets/images/blog-post-01.jpg' alt=''>
                          </div>
        
                          <div class='down-content'>
                            <span>".$row['cat_name']."</span>
                            <a href='post-details.html'>
                              <h4>".$row['title']."</h4>
                            </a>
                            <ul class='post-info'>
                              <li><a href='#'>".$row['type']." </a></li>
                              <li><a href='#'>".$row['publish_date']."</a></li>
                              <li><a href='#'>".$comments_number." Comments</a></li>
                            </ul>
                            <p>".$row['content']."</p>
                            <div class='post-options'>
                              <div class='row'>
                                <div class='col-6'>
                                  <ul class='post-tags'>
                                    <li><i class='fa fa-tags'></i></li>
                                    ".$tagsHTML."
                                  </ul>
                                </div>
                                <div class='col-6'>
                                  <ul class='post-share'>
                                    <li><i class='fa fa-share-alt'></i></li>
                                    <li><a href='#'>Facebook</a>,</li>
                                    <li><a href='#'> Twitter</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
        
      
                      ";
                      $success = true;
                    }
                  }
                  mysqli_close($conn);
              ?>
              
              

              <!--
              <div class="col-lg-12">
                <div class="blog-post">
                  <div class="blog-thumb">
                    <img src="assets/images/blog-post-02.jpg" alt="">
                  </div>
                  <div class="down-content">
                    <span>Healthy</span>
                    <a href="post-details.html">
                      <h4>Etiam id diam vitae lorem dictum</h4>
                    </a>
                    <ul class="post-info">
                      <li><a href="#">Admin</a></li>
                      <li><a href="#">May 24, 2020</a></li>
                      <li><a href="#">36 Comments</a></li>
                    </ul>
                    <p>You can support us by contributing a little via PayPal. Please contact <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">TemplateMo</a> via Live Chat or Email. If you have any question or feedback about this template, feel free to talk to us. Also, you may check other CSS templates such as <a rel="nofollow" href="https://templatemo.com/tag/multi-page" target="_parent">multi-page</a>, <a rel="nofollow" href="https://templatemo.com/tag/resume" target="_parent">resume</a>, <a rel="nofollow" href="https://templatemo.com/tag/video" target="_parent">video</a>, etc.</p>
                    <div class="post-options">
                      <div class="row">
                        <div class="col-6">
                          <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            <li><a href="#">Best Templates</a>,</li>
                            <li><a href="#">TemplateMo</a></li>
                          </ul>
                        </div>
                        <div class="col-6">
                          <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#">Twitter</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="blog-post">
                  <div class="blog-thumb">
                    <img src="assets/images/blog-post-03.jpg" alt="">
                  </div>
                  <div class="down-content">
                    <span>Fashion</span>
                    <a href="post-details.html">
                      <h4>Donec tincidunt leo nec magna</h4>
                    </a>
                    <ul class="post-info">
                      <li><a href="#">Admin</a></li>
                      <li><a href="#">May 14, 2020</a></li>
                      <li><a href="#">48 Comments</a></li>
                    </ul>
                    <p>Nullam at quam ut lacus aliquam tempor vel sed ipsum. Donec pellentesque tincidunt imperdiet. Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo. Phasellus interdum, diam commodo egestas rhoncus, turpis nisi consectetur nibh, in vehicula eros orci vel neque.</p>
                    <div class="post-options">
                      <div class="row">
                        <div class="col-6">
                          <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            <li><a href="#">HTML CSS</a>,</li>
                            <li><a href="#">Photoshop</a></li>
                          </ul>
                        </div>
                        <div class="col-6">
                          <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#">Twitter</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  -->
              <!-- Task Ends Here -->
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="blog.html">View All Posts</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <div class="row">
              <div class="col-lg-12">
                <div class="sidebar-item search">
                  <form id="search_form" name="gs" method="GET" action="#">
                    <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                  </form>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                  <div class="sidebar-heading">
                    <h2>Recent Posts</h2>
                  </div>
                  <div class="content">
                    <ul>
                      <li><a href="post-details.html">
                          <h5>Vestibulum id turpis porttitor sapien facilisis scelerisque</h5>
                          <span>May 31, 2020</span>
                        </a></li>
                      <li><a href="post-details.html">
                          <h5>Suspendisse et metus nec libero ultrices varius eget in risus</h5>
                          <span>May 28, 2020</span>
                        </a></li>
                      <li><a href="post-details.html">
                          <h5>Swag hella echo park leggings, shaman cornhole ethical coloring</h5>
                          <span>May 14, 2020</span>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="sidebar-item categories">
                  <div class="sidebar-heading">
                    <h2>Categories</h2>
                  </div>
                  <div class="content">
                    <ul>
                      <li><a href="#">- Nature Lifestyle</a></li>
                      <li><a href="#">- Awesome Layouts</a></li>
                      <li><a href="#">- Creative Ideas</a></li>
                      <li><a href="#">- Responsive Templates</a></li>
                      <li><a href="#">- HTML5 / CSS3 Templates</a></li>
                      <li><a href="#">- Creative &amp; Unique</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="sidebar-item tags">
                  <div class="sidebar-heading">
                    <h2>Tag Clouds</h2>
                  </div>
                  <div class="content">
                    <ul>
                      <li><a href="#">Lifestyle</a></li>
                      <li><a href="#">Creative</a></li>
                      <li><a href="#">HTML5</a></li>
                      <li><a href="#">Inspiration</a></li>
                      <li><a href="#">Motivation</a></li>
                      <li><a href="#">PSD</a></li>
                      <li><a href="#">Responsive</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once('layout/footer.php') ?>