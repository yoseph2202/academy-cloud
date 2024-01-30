<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('purchase_history'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="card">
  <div class="card-body">
    <table id="basic-datatable" class="table table-striped table-centered mb-0">
      <thead>
        <tr>
          <th><?php echo get_phrase('user'); ?></th>
          <th><?php echo get_phrase('course'); ?></th>
          <th><?php echo get_phrase('paid_amount'); ?></th>
          <th><?php echo get_phrase('payment_method'); ?></th>
          <th><?php echo get_phrase('purchased_date'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($purchase_history->result_array() as $purchase):
            $user_data = $this->db->get_where('users', array('id' => $purchase['user_id']))->row_array();
            $course_data = $this->db->get_where('course', array('id' => $purchase['course_id']))->row_array();?>
            <tr class="gradeU">
              <td>
                  <?php echo $user_data['first_name'].' '.$user_data['last_name']; ?><br>
                  <small class="badge badge-light"><?php echo $user_data['email']; ?></small>
              </td>
              <td><a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_data['title'])) . '/' . $course_data['id']); ?>" target="_blank"><?php echo $course_data['title']; ?></a></td>
              <td>
                <?php echo currency($purchase['amount']+$purchase['tax']); ?><br>
              </td>
              <td><?php echo ucfirst($purchase['payment_type']); ?></td>
              <td><?php echo date('D, d-M-Y', $purchase['date_added']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>