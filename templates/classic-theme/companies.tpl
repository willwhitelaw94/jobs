{OVERALL_HEADER}
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_COMPANIES}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_COMPANIES}</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<div class="container margin-bottom-50">
    <div class="col-xl-12">
        <form>
            <div class="input-with-icon">
                <input class="with-border" type="text" placeholder="{LANG_SEARCH}..." name="keyword"
                       value="{KEYWORD}">
                <i class="icon-feather-search"></i>
            </div>
        </form>
        <div class="companies-list">
            IF({TOTAL}){
            {LOOP: COMPANIES}
            <a href="{COMPANIES.link}" class="company">
                <div class="company-inner-alignment">
                    <span class="company-logo"><img src="{SITE_URL}storage/products/{COMPANIES.image}" alt=""></span>
                    <h4>{COMPANIES.name} ({COMPANIES.jobs})</h4>
                </div>
            </a>
            {/LOOP: COMPANIES}
            {ELSE}
            <p>{LANG_NO_RESULT_FOUND}</p>
            {:IF}
        </div>
        <!-- Pagination -->
        <div class="pagination-container margin-top-20">
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
{OVERALL_FOOTER}