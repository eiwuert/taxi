<section id="contact">
        <div class="container">
            <div class="row text-center clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="contact-heading">
                        <h2 class="title-one">Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="contact-details">
                <div class="pattern"></div>
                <div class="row text-center clearfix">
                    <div class="col-sm-6">
                        <div class="contact-address wow rotateInUpRight">
                            <address>
                                <h2>Flip App</h2><strong style="line-height: 25px">#2, 16th Floor Negar Tower,Vanak Sq.Tehran <br> 1969833693,IRAN 
                                <br> TEL : +98 21 88652990-3 <br> FAX : +98 21 886 41639 <br> EMAIL : info@flipapp.ir</strong>
                                <br>
                                <br>
                                <div>
                                    <img class="img-qr" src="../../images/en-barcode.png" alt="">
                                </div>
                                <div>
                                    
                                    <img class="enamad" id='rgvlgwmdbrgwbrgwsgui' style='cursor:pointer' onclick='window.open
                                    ("https://trustseal.enamad.ir/Verify.aspx?id=59660&p=yncrjzpghwmbhwmbdrfs", 
                                    "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30")
                                    ' alt='' src='../images/logo.aspx'/>
                                    </div>
                        </div>
                    </div>
                        <div class="col-sm-6">
                        <div id="contact-form-section" class="wow rotateInUpLeft">
                            <div class="status alert alert-success" style="display: none"></div>
                            @include('components.bootstrap.flash')
                                {!! Form::open(['method' => 'POST', 'url' => 'fa/contacts', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Subject (*) : ')]) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Email (*) : '), 'dir' => 'ltr']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Text (*) : ')]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::text('captcha', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Captcha (*) : '), 'dir' => 'ltr']) !!}
                                    </div>
                                    <div class="col-md-4">
                                         {!! captcha_img() !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>