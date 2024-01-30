
<?php
    $instructor_list = $this->user_model->get_instructor_list()->result_array();
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

                <div class="row radius-8 box-shadow-4 mx-0 mb-3">
                    <div class="col-12 py-2">
                        <button class="btn btn-outline-secondary float-end" type="button" id="NewMessage" onclick="NewMessage(event)"> <i class="fas fa-plus"></i> <?php echo site_phrase('compose'); ?></button>
                    </div>
                </div>
                <div class="row no-gutters align-items-stretch pb-3">
                    <div class="col-lg-5 bg-white">
                        <div class="message-sender-list-box">
                            <ul class="message-sender-list">

                                <?php
                                $current_user = $this->session->userdata('user_id');
                                $this->db->where('sender', $current_user);
                                $this->db->or_where('receiver', $current_user);
                                $message_threads = $this->db->get('message_thread')->result_array();
                                foreach ($message_threads as $row):

                                    // defining the user to show
                                    if ($row['sender'] == $current_user)
                                    $user_to_show_id = $row['receiver'];
                                    if ($row['receiver'] == $current_user)
                                    $user_to_show_id = $row['sender'];

                                    $last_messages_details =  $this->crud_model->get_last_message_by_message_thread_code($row['message_thread_code'])->row_array();
                                    ?>
                                    <a href="<?php echo site_url('home/my_messages/read_message/'.$row['message_thread_code']); ?>">
                                        <li class="<?php if (isset($message_thread_code) && $message_thread_code == $row['message_thread_code'])echo 'active'; ?>">
                                            <div class="message-sender-wrap">
                                                <div class="message-sender-head clearfix">
                                                    <div class="message-sender-info d-inline-block">
                                                        <div class="sender-image d-inline-block">
                                                            <img src="<?php echo $this->user_model->get_user_image_url($user_to_show_id);?>" alt="" class="img-fluid">
                                                        </div>
                                                        <div class="sender-name d-inline-block">
                                                            <?php
                                                            $user_to_show_details = $this->user_model->get_all_user($user_to_show_id)->row_array();
                                                            echo $user_to_show_details['first_name'].' '.$user_to_show_details['last_name'];
                                                            ?>
                                                            <?php if($unreaded_message > 0): ?>
                                                                <span class="badge bg-warning"><?php echo $unreaded_message; ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="message-time d-inline-block float-end"><?php echo date('D, d-M-Y', $last_messages_details['timestamp']); ?></div>
                                                </div>
                                                <div class="message-sender-body">
                                                    <?php echo $last_messages_details['message']; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 p-0">
                        <div class="message-details-box <?php if (isset($message_thread_code)){}else{ echo 'd-hidden'; } ?>" id = "toggle-1">
                            <?php include 'inner_messages.php'; ?>
                        </div>
                        <div class="message-details-box <?php if (isset($message_thread_code))echo 'd-hidden'; ?>" id = "toggle-2">
                            <div class="new-message-details"><div class="message-header mt-3">
                                <div class="sender-info">
                                    <span class="d-inline-block">
                                        <i class="far fa-user"></i>
                                    </span>
                                    <span class="d-inline-block"><?php echo site_phrase('new_message'); ?></span>
                                </div>
                            </div>
                            <form class="" action="<?php echo site_url('home/my_messages/send_new'); ?>" method="post">
                                <div class="message-body">
                                    <div class="form-group mb-3">
                                        <select class="form-control" name = "receiver">
                                            <?php foreach ($instructor_list as $instructor):
                                                if ($instructor['id'] == $this->session->userdata('user_id'))
                                                    continue;
                                                ?>
                                                <option value="<?php echo $instructor['id']; ?>"><?php echo $instructor['first_name'].' '.$instructor['last_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <textarea name="message" class="form-control radius-8"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-secondary px-4 ms-3 float-end"><?php echo site_phrase('send'); ?> <i class="fas fa-location-arrow"></i></button>
                                    <button type="button" class="btn btn-light float-end" onclick = "CancelNewMessage(event)">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
function NewMessage(e){

    e.preventDefault();
    $('#toggle-1').toggle();
    $('#toggle-2').toggle();
    //$('#NewMessage').removeAttr('onclick');
}

function CancelNewMessage(e){

    e.preventDefault();
    $('#toggle-2').hide();
    $('#toggle-1').show();

    $('#NewMessage').attr('onclick','NewMessage(event)');
}
</script>
