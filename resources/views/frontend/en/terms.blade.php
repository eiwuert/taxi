@include('frontend.includes.english.head')
        <div class="navbar navbar-static-top" id="nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i>
                    </button>
                    <a class="navbar-brand" href="{{ url('en/global') }}">
                        {{ HTML::image('images/logo.png', 'Logo') }}
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right social hidden-xs hidden-sm">
                        <li>
                            <a href="https://twitter.com/flipapp96" target="_blank">
                                <i class="fa fa-twitter fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/flip-application-63abb5141" target="_blank">
                                <i class="fa fa-linkedin fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/profile.php?id=100016712433417" target="_blank">
                                <i class="fa fa-facebook fa-lg"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://t.me/flipapp" target="_blank">
                                <i class="fa fa-paper-plane"></i>
                            </a>
                        </li>
                        <li>
                            <a href="flipapp96@gmail.com" target="_blank">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/flipapplication/" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav links-to-collaps">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ HTML::image('images/en.png') }} <span class="hidden-sm hidden-md hidden-lg">Language</span></a>
                            <ul class="dropdown-menu">
                                <li class="lang">
                                    <a class="" href="{{ url('/') }}" title="فارسی">{{ HTML::image('images/fa.png') }} فارسی</a>
                                </li>
                                <li class="lang">
                                    <a class="active" href="{{ url('en/global') }}" title="English">{{ HTML::image('images/en.png') }} English</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-link"><a href="{{ url('en/global') }}">Flip</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-sm-12 trans-blk">
                <link rel="stylesheet" href="../css/more.css">
                <h2>Terms and Conditions</h2>
                <hr>
                <p>This Mobile Application Terms and Conditions of Use and End User License Agreement is a binding agreement between you (End User or you) and Automated Service Provider. This Agreement governs your use of the service mobile software application (including all related documentation, the Application or the App).BY USING THE SERVICE, YOU ACKNOWLEDGE AND AGREE TO THESE TERMS OF SERVICE, AND Automated Service PRIVACY POLICY</p>
                <p>By selecting the checkbox button you
                </p><ol type="a">
                <li>acknowledge that you have read and understand this agreement;</li>
                <li>represent that you are of legal age to enter into a binding agreement; and </li>
                <li>accept this agreement and agree that you are legally bound by its terms.</li>
            </ol>
            If you do not agree to these terms, do not download/install/use the application and delete it from your mobile device.<p></p>
            <h4>Terms:</h4>
            <p>
            </p><ol>
            <li>In order to access and use the features of the Service, you acknowledge and agree that you will have to provide Automated Service with your mobile phone number email , address . You expressly acknowledge and agree that in order to provide the Service, Automated Service access find and track of your location to use the  Service when user want service at him/her location. When providing your mobile phone number, you must provide accurate and complete information. You hereby give your express consent to Automated Service to access your Location in order to provide and use the Service. We do collect names, addresses or email addresses, mobile phone numbers. You must notify Automated Service immediately of any breach of security or unauthorized use of your mobile phone. Although Automated Service will not be liable for your losses caused by any unauthorized use of your account, you may be liable for the losses of Automated Service or others due to such unauthorized use.</li>
            <li>The design of the Automated Service Service along with Automated Service created text, scripts, graphics, interactive features (as defined below), and the trademarks, service marks and logos contained therein ("Marks"), are owned by or licensed to Automated Service, subject to copyright and other intellectual property rights under United States and foreign laws and international conventions.</li>
        </ol>
        <p></p>
        <h4>Conditions:</h4>
        <p>
        </p><ol class="inner-count">
        <li>YOU AGREE THAT YOUR USE OF THE Automated Service, SERVICE SHALL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW,Flip, ITS OFFICERS, DIRECTORS, EMPLOYEES, AND AGENTS DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICE AND YOUR USE THEREOF. Automated Service MAKES NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THIS SERVICE'S CONTENT AND ASSUMES NO LIABILITY OR RESPONSIBILITY FOR ANY.
            <ol class="inner-count">
                <li>ERRORS, MISTAKES, OR INACCURACIES OF CONTENT,</li>
                <li>PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF OUR SERVICE,</li>
                <li>ANY UNAUTHORISED ACCESS TO OR USE OF OUR SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN,</li>
                <li>ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM OUR SERVICE,</li>
                <li>ANY BUGS, VIRUSES, TROJAN HORSES, OR</li>
                <li>ANY ERRORS OR OMISSION SIN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE Automated Service SERVICE.</li>
                <li>Automated Service DOES NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE Automated Service SERVICE OR ANY HYPERLINKED BSITE OR FEATURED IN ANY USER STATUS SUBMISSION OR OTHER ADVERTISING, AND Automated Service WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRDÂ­PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</li>
            </ol>
        </li>
    </ol>
    <p></p>
</div>
</div>
@include('frontend.includes.english.contact')
@include('frontend.includes.english.footer')
</body>
</html>