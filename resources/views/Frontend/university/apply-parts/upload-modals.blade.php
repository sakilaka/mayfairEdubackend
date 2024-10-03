<div class="upload-modals"> <!-- Upload Modal -->
    {{-- <div class="modal fade" id="doc0" tabindex="-1" role="dialog" aria-labelledby="doc0Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Statement of Financial Support for International Students</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-md-flex justify-content-between">
            <div class="col-md-6">



            <div class="doc-instruction">
            <h5 class="multisteps-form__title">Instructions</h5>
            <a href="https://www.china-admissions.com/wp-content/uploads/2021/12/Statement-of-Financial-Support-for-International-Students-FDU.pdf" target="_blank">Click here to download the Statement of Financial Support for International Students template.</a>


            </div>

            </div>


            <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container0" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                @csrf

                <input type="hidden" name="title" value="Statement of Financial Support for International Students - FDU">
                <input id="code" type="hidden" name="code" value="CA7049B7">
                <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
            </form>




            </div>

            <div class="modal-footer justify-content-between footer-actions">
                <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
            </div>

            </div>
        </div>
    </div> <!-- Upload Modal --> --}}
    <div class="modal fade" id="docguarantorpassword" tabindex="-1" role="dialog" aria-labelledby="doc1Title" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Guarantor’s Passport</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-md-flex justify-content-between">
            <div class="col-md-6">


           
            <div class="doc-instruction">
            <h5 class="multisteps-form__title">Instructions</h5>
            Please provide a copy of your Guarantor’s ID or passport. Your guarantor must be your family, relatives, or close friend. Your guarantor will act as your emergency contact. You cannot upload your own ID here even though you are financially responsible for your studies in China.


            </div>

            </div>


            <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container1" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                 @csrf
                <input type="hidden" name="title" value="Guarantor’s Passport">
                <input id="code" type="hidden" name="code" value="CA7049B7">
                <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

            <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div></form>




            </div>

            <div class="modal-footer justify-content-between footer-actions">
                <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
            </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docacademicstudeorprojectproposal" tabindex="-1" role="dialog" aria-labelledby="doc2Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Academic Study Plan or Project Proposal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-md-flex justify-content-between">
            <div class="col-md-6">
            <div id="video_965652" preload="none" class="swarm-fluid smartvideo-player vjs-swarmify-theme fitvidsignore dimensions-video_965652 vjs-paused vjs-controls-enabled vjs-user-inactive" src="" style=""><video src="blob:https://apply.china-admissions.com/6403f615-0107-484d-ae6a-800e80e3e894" class="vjs-tech" preload="none" id="video_965652_html5_api"></video><div></div><div class="vjs-poster" tabindex="-1" data-background-image="https://video-node.swarmcdn.com/8391afc9-113c-49fc-baa4-f9a6ad26b160/e29c0c751a79c96cd313570de603003c5aad6ec48e51ea64f52d5dd407381abb.jpg"></div><div class="vjs-loading-spinner"></div><div class="vjs-swarmify-disabled" role="button" aria-live="polite" tabindex="0" aria-label="disabled"><div class="vjs-control-content"><span class="vjs-control-text">Need Text</span></div></div><div class="vjs-swarmify-play-button" role="button" aria-live="polite" tabindex="0" aria-label="play video"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336" class="swarmify-play-button hexagon"><defs><path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z"></path><path id="t" d="M53.499 7.951l51.961 90H1.539z"></path></defs><g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round"><g id="hex" transform="translate(-11 10)"><use xlink:href="#h" height="100%" width="100%"></use><path stroke-width="10" d="M158-5.774l141.83 81.888v163.77L158 321.774l-141.83-81.88V76.124L158-5.77z"></path></g><g transform="rotate(-30 289.199 -57.894)" id="tri"><use xlink:href="#t" height="100%" width="100%"></use><path stroke-width="4" d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path></g></g></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336" class="swarmify-play-button rectangle"><defs><path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z"></path><path id="t" d="M53.499 7.951l51.961 90H1.539z"></path></defs><g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round"><g id="hex"><rect width="280" height="174" x="50%" y="50%" transform="translate(-140,-87)" id="svg_3" stroke-width="10"></rect></g><g transform="rotate(-30 289.199 -57.894)" id="tri"><use xlink:href="#t" height="100%" width="100%"></use><path stroke-width="4" d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path></g></g></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336" class="swarmify-play-button circle"><defs><path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z"></path><path id="t" d="M53.499 7.951l51.961 90H1.539z"></path></defs><g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round"><g id="hex"><circle cx="50%" cy="50%" r="125" id="svg_3" stroke-width="10"></circle></g><g transform="rotate(-30 289.199 -57.894)" id="tri"><use xlink:href="#t" height="100%" width="100%"></use><path stroke-width="4" d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path></g></g></svg></div><div class="vjs-swarmify-watermark vjs-swarmify-watermark-bottom-right" role="button" aria-live="polite" tabindex="0" aria-label="watermark"><a rel="noopener" target="_blank" href="https://swarmify.com/player/learn-more/?utm_campaign=wtrmrk&amp;utm_medium=player&amp;utm_source=apply.china-admissions.com"><img src="https://assets.swarmcdn.com/cross/images/swarmify_logo_grey.png" loading="lazy" width="2265" height="567" alt="Swarmify Video Hosting"></a></div><div class="vjs-control-bar" style=""><div class="vjs-play-control vjs-control " role="button" aria-live="polite" tabindex="0"><div class="vjs-control-content"><span class="vjs-control-text">Play</span></div></div><div class="vjs-current-time vjs-time-controls vjs-control" style="display: none;"><div class="vjs-current-time-display" aria-live="off"><span class="vjs-control-text">Current Time</span> 0:00</div></div><div class="vjs-time-divider" style="display: none;"><div><span>/</span></div></div><div class="vjs-duration vjs-time-controls vjs-control" style="display: none;"><div class="vjs-duration-display" aria-live="off"><span class="vjs-control-text">Duration Time</span> 0:00</div></div><div class="vjs-remaining-time vjs-time-controls vjs-control" style="display: block;"><div class="vjs-remaining-time-display" aria-live="off"><span class="vjs-control-text">Remaining Time</span> -0:00</div></div><div class="vjs-live-controls vjs-control"><div class="vjs-live-display" aria-live="off"><span class="vjs-control-text">Stream Type</span>LIVE</div></div><div class="vjs-progress-control vjs-control"><div role="slider" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" tabindex="0" class="vjs-progress-holder vjs-slider" aria-label="video progress bar" aria-valuetext="0:00"><div class="vjs-load-progress"><span class="vjs-control-text"><span>Loaded</span>: 0%</span></div><div class="vjs-play-progress" style="width: 0%;"><span class="vjs-control-text"><span>Progress</span>: 0%</span></div><div class="vjs-seek-handle vjs-slider-handle" aria-live="off" style="left: 0%;"><span class="vjs-control-text">0:00</span></div></div></div><div class="vjs-fullscreen-control vjs-control " role="button" aria-live="polite" tabindex="0"><div class="vjs-control-content"><span class="vjs-control-text">Fullscreen</span></div></div><div class="vjs-swarmify-signal-icon vjs-menu-button vjs-control swarm-on" style="display: none;"><div class="signal-popup vjs-menu"><a rel="noopener" target="_blank" href="https://swarmify.com/player/learn-more/"><div class="vjs-menu-content"><div class="signal-title">Video Acceleration:</div><div class="signal-on-text">On</div><div class="signal-off-text">Off</div><br></div></a></div></div><div class="vjs-volume-control vjs-control"><div role="slider" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" tabindex="0" class="vjs-volume-bar vjs-slider" aria-label="volume level" aria-valuetext="100%"><div class="vjs-volume-level" style="width: 100%;"><span class="vjs-control-text"></span></div><div class="vjs-volume-handle vjs-slider-handle" style="left: 100%;"><span class="vjs-control-text">00:00</span></div></div></div><div class="vjs-mute-control vjs-control vjs-vol-3" role="button" aria-live="polite" tabindex="0"><div><span class="vjs-control-text">Mute</span></div></div><div class="vjs-playback-rate vjs-menu-button vjs-control" aria-haspopup="true" role="button"><div class="vjs-control-content"><span class="vjs-control-text">Playback Rate</span></div><div class="vjs-playback-rate-value">1x</div><div class="vjs-menu"><ul class="vjs-menu-content"><li class="vjs-menu-item" role="button" aria-live="polite" tabindex="0" aria-selected="false">2x</li><li class="vjs-menu-item" role="button" aria-live="polite" tabindex="0" aria-selected="false">1.5x</li><li class="vjs-menu-item" role="button" aria-live="polite" tabindex="0" aria-selected="false">1.25x</li><li class="vjs-menu-item vjs-selected" role="button" aria-live="polite" tabindex="0" aria-selected="true">1x</li><li class="vjs-menu-item" role="button" aria-live="polite" tabindex="0" aria-selected="false">0.75x</li><li class="vjs-menu-item" role="button" aria-live="polite" tabindex="0" aria-selected="false">0.5x</li></ul></div></div><div class="vjs-subtitles-button vjs-menu-button vjs-control " role="button" aria-live="polite" tabindex="0" aria-haspopup="true" aria-label="Subtitles Menu" style="display: none;"><div class="vjs-control-content"><span class="vjs-control-text">Subtitles</span><div class="vjs-menu"><ul class="vjs-menu-content"><li class="vjs-menu-item vjs-selected" role="button" aria-live="polite" tabindex="0" aria-selected="true">subtitles off</li></ul></div></div></div><div class="vjs-captions-button vjs-menu-button vjs-control " role="button" aria-live="polite" tabindex="0" aria-haspopup="true" aria-label="Captions Menu" style="display: none;"><div class="vjs-control-content"><span class="vjs-control-text">Captions</span><div class="vjs-menu"><ul class="vjs-menu-content"><li class="vjs-menu-item vjs-selected" role="button" aria-live="polite" tabindex="0" aria-selected="true">captions off</li></ul></div></div></div><div class="vjs-chapters-button vjs-menu-button vjs-control " role="button" aria-live="polite" tabindex="0" aria-haspopup="true" aria-label="Chapters Menu" style="display: none;"><div class="vjs-control-content"><span class="vjs-control-text">Chapters</span><div class="vjs-menu"><ul class="vjs-menu-content"><li class="vjs-menu-title">Chapters</li></ul></div></div></div></div><div class="vjs-error-display"><div></div></div></div>


            <div class="doc-instruction">
            <h5 class="multisteps-form__title">Instructions</h5>
            The research proposal is for the PhD only. The research proposal tells what are you going to do in the future study and your area of research interest. Please don’t just upload an old paper or publication. The research plan is important because the academic committee or supervisor will judge whether your research interests meet with the program and make the decision.


            </div>

            </div>


            <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container2" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                 @csrf
                <input type="hidden" name="title" value="Academic Study Plan or Project Proposal">
                <input id="code" type="hidden" name="code" value="CA7049B7">
                <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

            <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div></form>




            </div>

            <div class="modal-footer justify-content-between footer-actions">
                <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
            </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docsecondrecommendationletter" tabindex="-1" role="dialog" aria-labelledby="doc3Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Second Recommendation Letter</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/8-rec-letter_dqoKdAf.png" style="max-width: 100%;"></div>

                            <div class="doc-instruction">

                                <h5 class="multisteps-form__title">Instructions</h5>
                                The recommendation letter must be printed on university official papers (if possible) and signed by the professor or teacher (if you are a high school graduate). The letter must include the full name of the recommender, the academic title, and contacts such as an email address and telephone number. To help make it easier you can use our recommendation letter tool <a target="_blank" href="https://www.china-admissions.com/recommendation-letter-tool/">here</a>
                                <br>
                                <br>This can sometimes take some time to send this. If you don't have it now you can complete your application and send this later
                                <br>
                                <br>
                                <a href="https://www.youtube.com/watch?v=MaUNTzwhImE&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare Your Recommendation Letter to Apply to Chinese Universities Video</a>


                            </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container3" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                         @csrf
                        <input type="hidden" name="title" value="Second Recommendation Letter">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docfirstrecommendationletter" tabindex="-1" role="dialog" aria-labelledby="doc4Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload First Recommendation Letter</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/8-rec-letter.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            The recommendation letter must be printed on university official papers (if possible) and signed by the professor or teacher (if you are a high school graduate). The letter must include the full name of the recommender, the academic title, and contacts such as an email address and telephone number.
                            <br>
                            <br>To help make it easier you can use our recommendation letter tool <a target="_blank" href="https://www.china-admissions.com/recommendation-letter-tool/">here</a>
                            <br>
                            <br>This can sometimes take some time to send this. If you don't have it now you can complete your application and send this later
                            <br>
                            <br><a href="https://www.youtube.com/watch?v=MaUNTzwhImE&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare Your Recommendation Letter to Apply to Chinese Universities Video</a>


                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container4" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="First Recommendation Letter">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docnocriminalcertificate" tabindex="-1" role="dialog" aria-labelledby="doc5Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload No Criminal Record Certificate</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/4-non-criminal.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Some universities request non-criminal record certificates. Normally you need to go to the local police station in your country and ask them for this certificate. It is sometimes called a Police Background Check. You can also search on google for “How to get a non-criminal record check from
                            <your country="">”
                                <br>
                                <br><a href="https://www.youtube.com/watch?v=vHqtT6mS7Hk&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare the Non-Criminal Record to Apply to Chinese Universities Video</a>


                            </your>
                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container5" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="No Criminal Record Certificate">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docmedicalexamform" tabindex="-1" role="dialog" aria-labelledby="doc6Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Medical Examination Form</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/3-medical.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            A medical examination is required while applying to Chinese universities. We can provide you with a template form that you can take to a local hospital in your country and go through the physical examination accordingly. Your physician will need to fill out the form, sign, and stamp it. Please fill out all fields and include all laboratory test results such as blood test/chest ray etc. test results together. Detailed blood test result should include the listed items: HIV, Syphilis Serodiagnosis, RPR, TPPA, HbsAg, AntiHCV, ALT/GPT, etc.
                            <br>
                            <br><a href="https://www.china-admissions.com/wp-content/uploads/2022/03/CA_Medical-Form_Template.pdf" target="_blank">Click here to download the Foreigner Physical Examination Form template.</a>
                            <br><a href="https://www.youtube.com/watch?v=zSwWLXHY1RA&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare the Medical Certificate to Apply to Chinese Universities</a>


                        </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container6" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Medical Examination Form">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docenglish_language_certificate" tabindex="-1" role="dialog" aria-labelledby="doc7Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload English Language Certificate</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            If you are applying for an English program and you are a native English speaker you do not need to send evidence of your English level. If you studied English before in high school or a degree, you can send evidence of this. Otherwise please send an English certificate which can be IELTS or TOEFL test certificate.
                            <br>
                            <br><a href="https://www.youtube.com/watch?v=-0yMyRkVlV4&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare the English Language Certificate to Apply to Chinese Universities Video</a>


                        </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container7" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="English Language Certificate">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="dochighest_academic_transcript" tabindex="-1" role="dialog" aria-labelledby="doc8Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Your Highest Academic Transcript (In English)</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/7-trans.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please send your highest academic transcript. This is the latest transcript of grades provided to you upon graduation from high school, undergraduate, or postgraduate degrees. The transcript should clearly show your subjects taken and grades received. If it is not in English or Chinese, you will need to translate it via official translating agencies.
                            <br>
                            <br><a href="https://www.youtube.com/watch?v=lD-bV4roZYI&amp;ab_channel=ChinaAdmissions" target="_blank">Watch How to Prepare Your Transcript to Apply to Chinese Universities Video</a>


                        </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container8" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Your Highest Academic Transcript (In English)">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docgraduationcertificate" tabindex="-1" role="dialog" aria-labelledby="doc9Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Your Graduation Certificate (in English)</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/6-grad.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            You need to provide your highest graduation certificate. If you haven't graduated yet from your school or university, then you can provide your transcript and a letter of expected graduation from your school or university (with an official stamp and signature). Then you can provide the graduation certificate at later date after graduation. If it is not in English or Chinese, you will need to translate it via official translating agencies.
                            <br>
                            <br><a href="https://www.youtube.com/watch?v=FUP5iVKrFyY" target="_blank">Watch How to Prepare Your Graduation Certificate to Apply to Universities in China Video</a>


                        </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container9" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Your Graduation Certificate (in English)">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docphotograph" tabindex="-1" role="dialog" aria-labelledby="doc10Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Your Photograph</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">

                        <div style="text-align: center;">
                            <img src="https://upload-china-admissions.imgix.net/uploads/doc_instructions/2-photo.png" style="max-width: 100%;">
                        </div>

                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a photo of yourself. This should be a passport type photo with white background. The file size should be minimum 100kb, and not bigger than 200kb in size. You can use <a href="https://tinypng.com" target="_blank">TinyPNG</a> to make it smaller, or <a href="https://www.photoresizer.com/" target="_blank">Photoresizer</a> to make it bigger if it's smaller than 100kb. This photo will be used for the university and for your visa application.
                            <br>
                            <br><a href="https://www.youtube.com/watch?v=ZyR97zTLZl4&amp;ab_channel=ChinaAdmissions" target="_blank">How to Prepare Your Personal Photo to Apply to Chinese Universities Video</a>


                        </div>

                    </div>


                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container10" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Your Photograph">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>

                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div> <!-- Upload Modal -->
    <div class="modal fade" id="docpassportcopy" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Your Passport Copy</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of your passport.
                            <br>
                            <br>The passport main page with photo needs to be uploaded. It is important that you have at least 1 years validity after the program starts.
                            <br>
                            <br>Please do not change your passport in the middle of the application process because it can jeopardize your visa application process. The passport number you use for registration is the passport number that will be used for your visa application.
                            <br>
                            <br>If you are currently renewing your passport, please let us know the date it will be ready. Your application for the visa can not be processed until you have the new passport – because the visa is related to your passport number.
                            <br>
                            <br>You can also check out our Passport Preparation video <a href=" https://www.youtube.com/watch?v=0s7BxZF99nQ" target="_blank">here</a>


                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Your Passport Copy">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docCurriculumVita" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Curriculum Vitae</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of your Curriculum Vitae.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="your Curriculum Vitae">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docCertificateFinancialGuarantor" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Certificate from the Financial Guarantor</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of Certificate from the Financial Guarantor.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="your Certificate from the Financial Guarantor">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docCurrentVisaPage" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Current Visa Page</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of Current Visa Page.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="your Current Visa Page">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docPersonalStatementLetter" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Personal Statement Letter</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of Personal Statement Letter.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="your Personal Statement Letter">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docInternationalSAU" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload International Students Application Form for Undergraduates</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of International Students Application Form for Undergraduates.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="International Students Application Form for Undergraduates">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="docMentalHealthReport" tabindex="-1" role="dialog" aria-labelledby="doc11Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Mental Health Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-md-flex justify-content-between">
                    <div class="col-md-6">



                        <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            Please upload a clear photo or scan of Mental Health Report.



                        </div>

                    </div>
                    <form class="dropzone col-md-6 d-flex justify-content-center dz-clickable" data-container="#doc-container11" method="post" action="{{ url('add-attachment/upload/'.$application->id) }}">
                        @csrf
                        <input type="hidden" name="title" value="Mental Health Report">
                        <input id="code" type="hidden" name="code" value="CA7049B7">
                        <input id="email" type="hidden" name="email" value="navieapc2@gmail.com">

                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files or click here to upload</button></div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between footer-actions">
                    <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-bs-dismiss="modal">Upload Later</button>
                </div>

            </div>
        </div>
    </div>
</div>
