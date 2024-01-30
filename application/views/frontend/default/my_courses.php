


<?php
    $my_courses = $this->user_model->my_courses()->result_array();

    $categories = array();
    foreach ($my_courses as $my_course) {
        $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
        if (!in_array($course_details['category_id'], $categories)) {
            array_push($categories, $course_details['category_id']);
        }
    }
?>

<section class="page-header-area my-course-area bg-danger">
  <div class="container-fluid p-0 position-relative">
    <div class="image-placeholder-1" style="background: #ec5252d9 !important; z-index: 1;"></div>
    <img src="<?php echo base_url('assets/frontend/default/img/education4.png'); ?>" style="min-width: 100%; height: 100%; position: absolute; bottom: 0px; right: 0px;">
    <div class="container" style="position: inherit;">
      <h1 class="page-title py-5 text-white print-hidden position-relative" style="z-index: 22;"><?php echo $page_title; ?></h1>
      <img class="w-sm-25" src="<?php echo base_url('assets/frontend/default/img/education.png'); ?>" style="height: 93%; position: absolute; right: 0; bottom: 0px; z-index: 5;">
    </div>
  </div>
</section>

<section class="user-dashboard-area pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-md-8 col-lg-9 mt-4 mt-md-0">
                <div class="row align-items-baseline bg-white radius-8 box-shadow-3 mx-0">
                    <div class="col-lg-6 py-2">
                        <div class="btn-group">
                            <a class="btn bg-background dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <?php echo site_phrase('categories'); ?>
                            </a>

                            <div class="dropdown-menu">
                                <?php foreach ($categories as $category):
                                    $category_details = $this->crud_model->get_categories($category)->row_array();
                                    ?>
                                    <a class="dropdown-item" href="javascript:;" id = "<?php echo $category; ?>" onclick="getCoursesByCategoryId(this.id)"><?php echo $category_details['name']; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            <a href="<?php echo site_url('home/my_courses'); ?>" class="btn bg-background" disabled><?php echo site_phrase('reset'); ?></a>
                        </div>
                    </div>
                    <div class="col-lg-6 py-2">
                        <form action="javascript:;">
                            <div class="input-group common-search-box">
                                <input type="text" class="form-control py-2" placeholder="<?php echo site_phrase('search_my_courses'); ?>" onkeyup="getCoursesBySearchString(this.value)">
                                <dib class="input-group-button">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </dib>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-3 no-gutters" id="my_courses_area">
                    <?php include 'reload_my_courses.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
function getCoursesByCategoryId(category_id) {
    $('#my_courses_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/my_courses_by_category'); ?>',
        data : {category_id : category_id},
        success : function(response){
            $('#my_courses_area').html(response);
        }
    });
}

function getCoursesBySearchString(search_string) {
    $('#my_courses_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/my_courses_by_search_string'); ?>',
        data : {search_string : search_string},
        success : function(response){
            $('#my_courses_area').html(response);
        }
    });
}
</script>
