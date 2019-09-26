<div class="col-md-3">
    <?php
    $this->load->view('includes/contacts_link');
    $this->load->view('includes/right_bar_link');
    if (!in_array($method, ['contact_us', 'free_assessment'])) :
        $this->load->view('includes/right_bar_enqform');
    endif;
    $this->load->view('includes/right_bar_testimonials');
    ?>
</div>