<?php
$this->db->where('user_id', $this->session->userdata('user_id'));
$purchase_history = $this->db->get('payment',$per_page, $this->uri->segment(3));
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
                <ul class="purchase-history-list">
                    <li class="purchase-history-list-header radius-8 box-shadow-3 mx-0 py-3">
                        <div class="row">
                            <div class="col-5 ps-4 fw-bold"> <?php echo site_phrase('purchased_courses'); ?></div>
                            <div class="col-7 hidden-xxs hidden-xs">
                                <div class="row">
                                    <div class="col-3 fw-bold"> <?php echo site_phrase('date'); ?> </div>
                                    <div class="col-2 fw-bold"> <?php echo site_phrase('price'); ?> </div>
                                    <div class="col-4 fw-bold"> <?php echo site_phrase('payment_type'); ?> </div>
                                    <div class="col-3 fw-bold"> <?php echo site_phrase('actions'); ?> </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php if ($purchase_history->num_rows() > 0):
                        foreach($purchase_history->result_array() as $each_purchase):
                            $course_details = $this->crud_model->get_course_by_id($each_purchase['course_id'])->row_array();?>
                            <li class="purchase-history-items radius-10 mt-3 box-shadow-3">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="purchase-history-course-img">
                                            <img src="<?php echo $this->crud_model->get_course_thumbnail_url($each_purchase['course_id']);?>" class="img-fluid">
                                        </div>
                                        <a class="purchase-history-course-title" href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>" >
                                            <?php
                                            echo $course_details['title'];
                                            ?>
                                        </a>
                                    </div>
                                    <div class="col-7 purchase-history-detail">
                                        <div class="row">
                                            <div class="col-3 date">
                                                <?php echo date('D, d-M-Y', $each_purchase['date_added']); ?>
                                            </div>
                                            <div class="col-2 price"><b>
                                                <?php echo currency($each_purchase['amount']); ?>
                                            </b></div>
                                            <div class="col-4 payment-type">
                                                <?php echo ucfirst($each_purchase['payment_type']); ?>
                                            </div>
                                            <div class="col-3">
                                                <a href="<?php echo site_url('home/invoice/'.$each_purchase['id']); ?>" target="_blank" class="ms-2 btn btn-receipt"><?php echo site_phrase('invoice'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                            <div class="row" style="text-align: center;">
                                <?php echo site_phrase('no_records_found'); ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
  if(addon_status('offline_payment') == 1):
    include "pending_purchase_course_history.php";
  endif;
?>
<nav>
    <?php echo $this->pagination->create_links(); ?>
</nav>
