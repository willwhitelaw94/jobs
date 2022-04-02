{OVERALL_HEADER}
{BREADCRUMBS}
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
        <div class="col-lg-9 col-md-12">
            <div class="listings-container ">
                <!-- Row -->
                <div class="row" style="margin-bottom: 20px">
                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">
                            <!-- Headline -->
                             <div class="headline">
                               <h3><i class="icon-feather-clock"></i> {LANG_MYTIMESHEET} &ndash; <a href="{LINK_ADD_SHIFT}">{LANG_ADD_SHIFT}</a></h3>
                            </div> 

                            <div class="content">
                                <ul class="dashboard-box-list">
                                    IF(!{TOTALITEM}){
                                        <div class="content with-padding text-center">
                                            {LANG_NO_SHIFT_FOUND}
                                        </div>
                                    {ELSE}   
                                    {LOOP: ITEM}
                                    <li id="content_section_{ITEM.id}">
                                        <!-- Job Listing -->
                                        <div class="job-listing width-adjustment">

                                            <!-- Job Listing Details -->
                                            <div class="job-listing-details">

                                                <!-- Details -->
                                                <div class="job-listing-description">
                                                    <h3 class="job-listing-title"><a href="#">{ITEM.fullname}</a> <span class="dashboard-status-button yellow">Overdue</span></h3>

                                                    <!-- Job Listing Footer -->
                                                    <div class="job-listing-footer">
                                                        <ul>
                                                            <li><i class="icon-material-outline-access-time"></i>{ITEM.hours} {ITEM.date}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Task Details -->
                                        <ul class="dashboard-task-info">
                                            <li><strong>${ITEM.due}</strong><span>Due</span></li>
                                            <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_SUBMITTED}</span></li>
                                            IF("{ITEM.status}"=="approved"){
                                                <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_APPROVED}</span></li>
                                                <li><strong><i class=""></i></strong><span>{LANG_PENDING}</span></li>
                                                <li><strong><i class=""></i></strong><span>{LANG_DISBURSED}</span></li>
                                            ELSEIF("{ITEM.status}"=="pending"){  
                                                <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_APPROVED}</span></li>
                                                <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_PENDING}</span></li>
                                                <li><strong><i class=""></i></strong><span>{LANG_DISBURSED}</span></li>  
                                            ELSEIF("{ITEM.status}"=="disbursed"){  
                                                    <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_APPROVED}</span></li>
                                                    <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_PENDING}</span></li>
                                                    <li><strong><i class="text-success fa fa-check-circle"></i></strong><span>{LANG_DISBURSED}</span></li>      
                                                
                                            ELSEIF("{ITEM.status}"=="rejected"){  
                                                <li><strong><i class="text-danger fa fa-times-circle"></i></strong><span>{LANG_REJECTED}</span></li>
                                              
                                            {ELSE}
                                                <li class="d-none reject_{ITEM.id}"><strong><i class="text-danger fa fa-times-circle"></i></strong><span>{LANG_REJECTED}</span></li>
                                                <li class="approve_{ITEM.id} icon-to-hide_{ITEM.id}"><strong><i class=""></i></strong><span>{LANG_APPROVED}</span></li>
                                                <li class="icon-to-hide_{ITEM.id}"><strong><i class=""></i></strong><span>{LANG_PENDING}</span></li>
                                                <li class="icon-to-hide_{ITEM.id}"><strong><i class=""></i></strong><span>{LANG_DISBURSED}</span></li>
                                            {:IF} 
                                        </ul>

                                        <!-- Buttons -->
                                        <div class="buttons-to-right always-visible btn_section_{ITEM.id}">
                                            IF('{USERTYPE}' == "employer" && "{ITEM.status}"=="submitted"){
                                            <a href="javascript:void(0)" class="button ripple-effect update_timesheet_status" data-status="approved" data-id="{ITEM.id}"><i class="icon-material-outline-supervisor-account"></i>{LANG_APPROVE}</a>
                                            <a href="javascript:void(0)" class="button ripple-effect update_timesheet_status" data-status="rejected" data-id="{ITEM.id}"><i class="icon-material-outline-supervisor-account"></i>{LANG_REJECT}</a>
                                            {:IF}
                                            IF('{USERTYPE}' == "user" && "{ITEM.status}"=="submitted"){
                                                <a href="{LINK_EDIT_SHIFT}/{ITEM.id}" class="button gray ripple-effect" title="Edit" data-tippy-placement="top" ><i class="icon-feather-edit"></i></a>
                                                <a href="javascript:void(0)" class="button gray ripple-effect delete-shift" title="Remove" data-tippy-placement="top" data-id="{ITEM.id}"><i class="icon-feather-trash-2"></i></a>
                                               
                                            {:IF}
                                        </div>
                                    </li>
                                   {/LOOP: ITEM}

                                    {:IF}
                                   
                                  
                                </ul> 
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Row / End --> 
            </div>
            IF("{TOTALITEM}"!="0"){
                    <div class="row">
                            <div class="col-md-12">
                                <!-- Pagination -->
                                <div class="pagination-container margin-top-20 margin-bottom-60">
                                    <nav class="pagination">
                                        <ul>
                                            {LOOP: PAGES}
                                                IF("{PAGES.current}"=="0"){
                                                <li><a href="{PAGES.link}">{PAGES.title}</a></li>
                                            {ELSE}
                                                <li><a href="#" class="current-page">{PAGES.title}</a></li>
                                            {:IF}
                                            {/LOOP: PAGES}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </div>
            {:IF}
         

        </div>
        </div>
    </div>
</div>


{OVERALL_FOOTER}
<script>
$(function(){
    $('.update_timesheet_status').click(function(){
        var id = $(this).data('id');
        var status = $(this).data('status');
        var data = { action: "updateTimesheetStatus", id: id,status:status};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            dataType: "json",
            success: function(resp){
              
                if(resp.status){
                    $('.btn_section_'+id+'').addClass('d-none')
                    if(status =='rejected'){
                        $('.reject_'+id+'').removeClass('d-none')
                        $('.icon-to-hide_'+id+'').addClass('d-none')
                    }else{
                        $('.approve_'+id+' i').addClass('text-success fa fa-check-circle')
                    }
                }
            }
        });
    })
    $('.delete-shift').click(function(){
        var id = $(this).data('id');
        var data = { action: "deleteTimesheet", id: id};
        $('#content_section_'+id+'').addClass('d-none')
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            dataType: "json",
            success: function(resp){
                if(resp.status){
                    $('#content_section_'+id+'').addClass('d-none')
                }
            }
        });
    })


});

</script>