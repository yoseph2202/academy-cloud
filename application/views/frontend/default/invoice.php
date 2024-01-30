<?php
$course_details = $this->crud_model->get_course_by_id($payment_info['course_id'])->row_array();
$buyer_details = $this->user_model->get_all_user($payment_info['user_id'])->row_array();
$sub_category_details = $this->crud_model->get_category_details_by_id($course_details['sub_category_id'])->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
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

                <div class="row print-content">
                    <div class="col">
                        <div style="margin-left:auto;margin-right:auto;">
                            <link href="<?php echo base_url('assets/frontend/elegant/css/print.css'); ?>" rel="stylesheet">
                            <div style="background: #eceff4; margin-top: 20px;">
                                <table class="w-100">
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url('uploads/system/').get_frontend_settings('dark_logo');?>" height="40" style="display:inline-block;">
                                        </td>
                                        <td style="font-size: 22px;" class="text-end strong"><?php echo strtoupper(site_phrase('invoice')); ?></td>
                                    </tr>
                                </table>
                                <table class="w-100">
                                    <tr>
                                        <td style="font-size: 1.2rem;" class="strong"><?php echo get_settings('system_name'); ?></td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td class="gry-color small"><?php echo get_settings('system_email'); ?></td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td class="gry-color small"><?php echo get_settings('address'); ?></td>
                                        <td class="text-end small"><span class="gry-color small"><?php echo site_phrase('payment_method'); ?>:</span> <span class="strong"><?php echo ucfirst($payment_info['payment_type']); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="gry-color small"><?php echo site_phrase('phone'); ?>: <?php echo get_settings('phone'); ?></td>
                                        <td class="text-end small"><span class="gry-color small"><?php echo site_phrase('purchase_date'); ?>:</span> <span class=" strong"><?php echo date('D, d-M-Y', $payment_info['date_added']); ?></span></td>
                                    </tr>
                                </table>

                            </div>
                            <hr class="bg-secondary">
                            <table>
                                <tr><td class="strong small gry-color"><?php echo site_phrase('bill_to'); ?>:</td></tr>
                                <tr><td class="strong"><?php echo $buyer_details['first_name'].' '.$buyer_details['last_name']; ?></td></tr>
                                <tr><td class="gry-color small"><?php echo site_phrase('email'); ?>: <?php echo $buyer_details['email']; ?></td></tr>
                            </table>
                            <hr class="bg-secondary">
                            <div style="">
                                <table class="padding text-left small border-bottom w-100">
                                    <thead>
                                        <tr class="gry-color" style="background: #eceff4;">
                                            <th width="50%"><?php echo site_phrase('course_name'); ?></th>
                                            <th width="15%" style="padding-left : 10px;"><?php echo site_phrase('category'); ?></th>
                                            <th width="15%"><?php echo site_phrase('instructor'); ?></th>
                                            <th width="20%" class="text-end"><?php echo site_phrase('total'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="strong">
                                        <tr class="">
                                            <td><?php echo $course_details['title']; ?></td>
                                            <td class="gry-color" style="padding-left : 10px;"><?php echo $sub_category_details['name']; ?></td>
                                            <td class="gry-color"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></td>
                                            <td class="text-end"><?php echo currency($payment_info['amount']); ?></td>
                                        </tr>
                                        <tr class="">
                                            <td></td>
                                            <td class="gry-color"></td>
                                            <td class="gry-color"> <strong><?php echo site_phrase('sub_total'); ?>:</strong> </td>
                                            <td class="text-end"><strong><?php echo currency($payment_info['amount']); ?></strong></td>
                                        </tr>
                                        <tr class="">
                                            <td></td>
                                            <td class="gry-color"></td>
                                            <td class="gry-color strong"><strong><?php echo site_phrase('grand_total'); ?></strong>:</td>
                                            <td class="text-end"><strong><?php echo currency($payment_info['amount']); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-print-none mb-2">
                    <a href="javascript:window.print()" class="btn btn-secondary float-end mt-2"> <i class="fas fa-print"></i> <?php echo site_phrase('print'); ?></a>
                </div>
        </div>
    </div>
</section>