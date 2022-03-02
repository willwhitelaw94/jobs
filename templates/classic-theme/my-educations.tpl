{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
            <div class="col-lg-9 col-md-12">
              
            <div class="dashboard-box margin-top-0">
                <div class="headline">
                    <h3><i class="icon-feather-award"></i> {LANG_MY_EDUCATIONS} &ndash; <a href="{LINK_ADD_EDUCATION}">{LANG_ADD_EDUCATION}</a></h3>
                </div>
                IF(!{TOTALITEM}){
                <div class="content with-padding text-center">
                    {LANG_NO_DATA_FOUND}
                </div>
                {:IF}
            </div>
            <div class="listings-container margin-top-35">
            {LOOP: ITEM}
                <div class="job-listing experience-row" data-item-id="{ITEM.id}">
                    <div class="job-listing-details">
                        <div class="job-listing-description">
                            <h3 class="job-listing-title">{ITEM.institution}</h3>
                            <h4 class="job-listing-company">{ITEM.course}</h4>
                        </div>
                        <a href="{LINK_EDIT_EDUCATION}/{ITEM.id}" class="" data-tippy-placement="top" title="{LANG_EDIT}"><i class="icon-feather-edit"></i></a>
                        <a href="#" class="margin-left-10 ajax-delete-experience" data-tippy-placement="top" title="{LANG_DELETE}"><i class="icon-feather-trash-2"></i></a>
                    </div>
                    <div class="job-listing-footer with-icon">
                        <ul>
                            <li><i class="la la-clock-o"></i> {ITEM.start_date} - {ITEM.end_date}</li>
                        </ul>
                    </div>
                </div>
            {/LOOP: ITEM}
            <div class="clearfix"></div>
        </div>
            </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}