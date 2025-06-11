        <!-- Section: Contact -->
        <section id="contact">
        <div class="container">
            <div class="section-title mb-10">
            <div class="row">
                <div class="col-md-12">
                <h2 class="text-uppercase text-theme-colored1 title line-bottom line-bottom-theme-colored1 line-height-1 mt-0">Contact <span class="text-theme-colored2 font-weight-400">Us</span></h2>
                </div>
            </div>
            </div>
            <div class="section-content">
            <div class="row">
                <div class="col-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7496.556775569473!2d144.95479118909844!3d-37.81548660764023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sbd!4v1562002563953!5m2!1sen!2sbd" width="2600" height="540" allowfullscreen></iframe>
                </div>
                <div class="col-md-7">
                <h4 class="line-bottom line-bottom-theme-colored1 mt-0 mb-30 mt-sm-20">Send Us a Message</h4>
                <!-- Contact Form -->
                <form id="contact_form" name="contact_form" class="" action="includes/sendmail.php" method="post">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 mb-30">
                        <input name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3 mb-30">
                        <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 mb-30">
                        <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3 mb-30">
                        <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                        </div>
                    </div>
                    </div>
                        <div class="mb-3">
                    <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
                    </div>
                        <div class="mb-3">
                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button type="submit" class="btn btn-flat btn-theme-colored1 text-uppercase mt-20 mb-sm-30 border-left-theme-colored2-4px" data-loading-text="Please wait...">Send your message</button>
                    <button type="reset" class="btn btn-flat btn-theme-colored1 text-uppercase mt-20 mb-sm-30 border-left-theme-colored2-4px">Reset</button>
                    </div>
                </form>
                <!-- Contact Form Validation-->
                <script type="text/javascript">
                    $("#contact_form").validate({
                    submitHandler: function(form) {
                        var form_btn = $(form).find('button[type="submit"]');
                        var form_result_div = '#form-result';
                        $(form_result_div).remove();
                        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                        var form_btn_old_msg = form_btn.html();
                        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                        $(form).ajaxSubmit({
                        dataType:  'json',
                        success: function(data) {
                            if( data.status == 'true' ) {
                            $(form).find('.form-control').val('');
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                        }
                        });
                    }
                    });
                </script>
                </div>
            </div>
            </div>
        </div>
        </section>