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
                <div class="row radius-8 box-shadow-4 mx-0">
                    <div class="ms-auto col-lg-6 px-3 py-2">
                        <form action="javascript:;">
                            <div class="input-group common-search-box">
                                <input type="text" class="form-control py-2" placeholder="<?php echo site_phrase('search_my_wishlist'); ?>"  onkeyup="getMyWishListsBySearchString(this.value)">
                                <dib class="input-group-button">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </dib>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row no-gutters mt-3" id="my_wishlists_area">
                    <?php include "reload_my_wishlists.php"; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function getMyWishListsBySearchString(search_string) {
        $('#my_wishlists_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/get_my_wishlists_by_search_string'); ?>',
            data: {
                search_string: search_string
            },
            success: function(response) {
                $('#my_wishlists_area').html(response);
            }
        });
    }

    async function handleWishList(elem) {


        try {
            var result = await async_modal();
            if (result) {
                $.ajax({
                    url: '<?php echo site_url('home/handleWishList'); ?>',
                    type: 'POST',
                    data: {
                        course_id: elem.id
                    },
                    success: function(response) {
                        if ($(elem).hasClass('active')) {
                            $(elem).removeClass('active')
                        } else {
                            $(elem).addClass('active')
                        }
                        $('#wishlist_items').html(response);
                        $.ajax({
                            url: '<?php echo site_url('home/reload_my_wishlists'); ?>',
                            type: 'POST',
                            success: function(response) {
                                $('#modal-4').modal('toggle');
                                $('#my_wishlists_area').html(response);
                            }
                        });
                    }
                });
            }
        } catch (e) {
            console.log("Error occured", e.message);
        }
    }
</script>