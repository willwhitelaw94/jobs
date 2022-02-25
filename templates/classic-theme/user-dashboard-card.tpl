<div class="dashboard-box margin-top-0">
    <div class="content with-padding">
        <div class="row dashboard-profile">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="dashboard-avatar-box">
                    <img src="{SITE_URL}storage/profile/{AVATAR}" alt="{LANG_NAME}">
                    <div>
                        <h2>{AUTHORNAME}</h2>
                        <small>{LANG_YOU_LOGIN}: {LASTACTIVE}</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 text-right">
                IF('{USERTYPE}' == "user"){
                IF({RESUME_ENABLE}){
                <span class="dashboard-badge"><strong>{RESUMES}</strong><i
                            class="icon-feather-paperclip"></i> {LANG_MY_RESUMES}</span>
                {:IF}
                <span class="dashboard-badge"><strong>{FAVORITEADS}</strong><i
                            class="icon-feather-heart"></i> {LANG_FAV_JOBS}</span>
                ELSEIF('{USERTYPE}' == "employer"){
                <span class="dashboard-badge"><strong>{MYADS}</strong><i
                            class="icon-feather-briefcase"></i> {LANG_JOBS}</span>
                <span class="dashboard-badge"><strong>
                        IF("{SUB_TITLE}"!=""){
                        {SUB_TITLE}
                        {ELSE}
                        {LANG_FREE}
                        {:IF}
                    </strong><i class="icon-feather-gift"></i> {LANG_MEMBERSHIP}
                </span>
                {:IF}
            </div>
        </div>
        <div class="row py-3">
            <div class="col-xl-12 col-md-12 col-sm-12 text-right">
              
                <a class="btn btn-sm btn-outline-warning" href="{LINK_PROFILE}/{USERNAME}">{LANG_PROFILE_PUBLIC}</a>
            </div>
        </div>

       
        
    </div>
</div>