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
                <form class="w-100 bg-white radius-10 p-4 box-shadow-5" action="<?php echo site_url('home/update_profile/update_photo'); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12 border-bottom mb-3 pb-3">
                            <h4><?php echo site_phrase('profile_photo'); ?></h4>
                            <p><?php echo site_phrase('update_your_photo'); ?></p>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="text-dark fw-600" for="email"><?php echo site_phrase('upload_image'); ?></label>
                            <div class="input-group">
                                <input type="file" class="form-control" name = "user_image" id="user_image">
                            </div>
                        </div>

                        <div class="col-12 pt-4">
                            <button class="btn red px-5 py-2 radius-8"> <i class="fas fa-upload"></i> <?php echo site_phrase('upload'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>