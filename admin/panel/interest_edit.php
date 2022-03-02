<?php
require_once('../datatable-json/includes.php');

$InteId = isset($_GET['id'])? $_GET['id'] : "";

$info = ORM::for_table($config['db']['pre'].'interests')->find_one($InteId);
//print_r($info);die;
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Interests & Hobbies</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="religion_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editInterest" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputfullname" placeholder="Name" name="name" required=""  value="<?php echo $info['name'];?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfulltype">Language Type<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputreligionname" placeholder="Religion Name" name="type" required=""  value="<?php echo $info['type'];?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div> -->
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="exampleInputfulltype">Language Type</label>
                                        <select class="select2-icon form-control" name="icon">
                                                <option value="fab fa-500px" <?php if($info['icon'] == 'fab fa-500px'){ echo 'selected'; } ?> data-select2-id="select2-data-10-e5hy">
                                                &lt;i class="fab fa-500px"&gt;&lt;/i&gt; 500px
                                                </option>
                                                <option value="fab fa-accessible-icon" <?php if($info['icon'] == 'fab fa-accessible-icon'){ echo 'selected'; } ?> data-select2-id="select2-data-11-43ct">
                                                    &lt;i class="fab fa-accessible-icon"&gt;&lt;/i&gt; Accessible Icon
                                                </option>
                                                <option value="fab fa-accusoft" <?php if($info['icon'] == 'fab fa-accusoft'){ echo 'selected'; } ?> data-select2-id="select2-data-12-4tj3">
                                                    &lt;i class="fab fa-accusoft"&gt;&lt;/i&gt; Accusoft
                                                </option>
                                                <option value="fas fa-address-book" <?php if($info['icon'] == 'fas fa-address-book'){ echo 'selected'; } ?> data-select2-id="select2-data-15-kl0e">
                                                    &lt;i class="fas fa-address-book"&gt;&lt;/i&gt; Address Book
                                                </option>
                                                <option value="fas fa-address-card" <?php if($info['icon'] == 'fas fa-address-card'){ echo 'selected'; } ?> data-select2-id="select2-data-16-ootm">
                                                    &lt;i class="fas fa-address-card"&gt;&lt;/i&gt; Address Card
                                                </option>
                                                <option value="fas fa-adjust" <?php if($info['icon'] == 'fas fa-adjust'){ echo 'selected'; } ?> data-select2-id="select2-data-17-el9r">
                                                    &lt;i class="fas fa-adjust"&gt;&lt;/i&gt; adjust
                                                </option>
                                                <option value="fab fa-adn" <?php if($info['icon'] == 'fab fa-adn'){ echo 'selected'; } ?> data-select2-id="select2-data-18-0sui">
                                                    &lt;i class="fab fa-adn"&gt;&lt;/i&gt; App.net
                                                </option>
                                                <option value="fab fa-adversal" <?php if($info['icon'] == 'fab fa-adversal'){ echo 'selected'; } ?> data-select2-id="select2-data-19-45o3">
                                                    &lt;i class="fab fa-adversal"&gt;&lt;/i&gt; Adversal
                                                </option>
                                                <option value="fab fa-affiliatetheme" <?php if($info['icon'] == 'fab fa-affiliatetheme'){ echo 'selected'; } ?> data-select2-id="select2-data-20-xdw7">
                                                    &lt;i class="fab fa-affiliatetheme"&gt;&lt;/i&gt; affiliatetheme
                                                </option>
                                                <option value="fab fa-algolia" <?php if($info['icon'] == 'fab fa-algolia'){ echo 'selected'; } ?> data-select2-id="select2-data-23-4sru">
                                                    &lt;i class="fab fa-algolia"&gt;&lt;/i&gt; Algolia
                                                </option>
                                                <option value="fas fa-align-center" <?php if($info['icon'] == 'fas fa-align-center'){ echo 'selected'; } ?> data-select2-id="select2-data-24-0ga0">
                                                    &lt;i class="fas fa-align-center"&gt;&lt;/i&gt; align-center
                                                </option>
                                                <option value="fas fa-align-justify" <?php if($info['icon'] == 'fas fa-align-justify'){ echo 'selected'; } ?> data-select2-id="select2-data-25-pzqo">
                                                    &lt;i class="fas fa-align-justify"&gt;&lt;/i&gt; align-justify
                                                </option>
                                                <option value="fas fa-align-left" <?php if($info['icon'] == 'fas fa-align-left'){ echo 'selected'; } ?> data-select2-id="select2-data-26-gaq7">
                                                    &lt;i class="fas fa-align-left"&gt;&lt;/i&gt; align-left
                                                </option>
                                                <option value="fas fa-align-right" <?php if($info['icon'] == 'fas fa-align-right'){ echo 'selected'; } ?> data-select2-id="select2-data-27-hoic">
                                                    &lt;i class="fas fa-align-right"&gt;&lt;/i&gt; align-right
                                                </option>
    
                                                <option value="fas fa-allergies" <?php if($info['icon'] == 'fas fa-allergies'){ echo 'selected'; } ?> data-select2-id="select2-data-29-wyez">
                                                    &lt;i class="fas fa-allergies"&gt;&lt;/i&gt; Allergies
                                                </option>
                                                <option value="fab fa-amazon" <?php if($info['icon'] == 'fab fa-amazon'){ echo 'selected'; } ?> data-select2-id="select2-data-30-zr36">
                                                    &lt;i class="fab fa-amazon"&gt;&lt;/i&gt; Amazon
                                                </option>
                                                <option value="fab fa-amazon-pay" <?php if($info['icon'] == 'fab fa-amazon-pay'){ echo 'selected'; } ?> data-select2-id="select2-data-31-muec">
                                                    &lt;i class="fab fa-amazon-pay"&gt;&lt;/i&gt; Amazon Pay
                                                </option>
                                                <option value="fas fa-ambulance" <?php if($info['icon'] == 'fas fa-ambulance'){ echo 'selected'; } ?> data-select2-id="select2-data-32-b3y9">
                                                    &lt;i class="fas fa-ambulance"&gt;&lt;/i&gt; ambulance
                                                </option>
                                                <option value="fas fa-american-sign-language-interpreting" <?php if($info['icon'] == 'fas fa-american-sign-language-interpreting'){ echo 'selected'; } ?> data-select2-id="select2-data-33-x9ak">
                                                    &lt;i class="fas fa-american-sign-language-interpreting"&gt;&lt;/i&gt; American Sign Language Interpreting
                                                </option>
                                                <option value="fab fa-amilia" <?php if($info['icon'] == 'fab fa-amilia'){ echo 'selected'; } ?> data-select2-id="select2-data-34-kv78">
                                                    &lt;i class="fab fa-amilia"&gt;&lt;/i&gt; Amilia
                                                </option>
                                                <option value="fas fa-anchor" <?php if($info['icon'] == 'fas fa-anchor'){ echo 'selected'; } ?> data-select2-id="select2-data-35-21ha">
                                                    &lt;i class="fas fa-anchor"&gt;&lt;/i&gt; Anchor
                                                </option>
                                                <option value="fab fa-android" <?php if($info['icon'] == 'fab fa-android'){ echo 'selected'; } ?> data-select2-id="select2-data-36-sufj">
                                                    &lt;i class="fab fa-android"&gt;&lt;/i&gt; Android
                                                </option>
                                                <option value="fab fa-angellist" <?php if($info['icon'] == 'fab fa-angellist'){ echo 'selected'; } ?> data-select2-id="select2-data-37-f11v">
                                                    &lt;i class="fab fa-angellist"&gt;&lt;/i&gt; AngelList
                                                </option>
                                                <option value="fas fa-angle-double-down" <?php if($info['icon'] == 'fas fa-angle-double-down'){ echo 'selected'; } ?> data-select2-id="select2-data-38-p3u1">
                                                    &lt;i class="fas fa-angle-double-down"&gt;&lt;/i&gt; Angle Double Down
                                                </option>
                                                <option value="fas fa-angle-double-left" <?php if($info['icon'] == 'fas fa-angle-double-left'){ echo 'selected'; } ?> data-select2-id="select2-data-39-w0bv">
                                                    &lt;i class="fas fa-angle-double-left"&gt;&lt;/i&gt; Angle Double Left
                                                </option>
                                                <option value="fas fa-angle-double-right" <?php if($info['icon'] == 'fas fa-angle-double-right'){ echo 'selected'; } ?> data-select2-id="select2-data-40-f9ir">
                                                    &lt;i class="fas fa-angle-double-right"&gt;&lt;/i&gt; Angle Double Right
                                                </option>
                                                <option value="fas fa-angle-double-up" <?php if($info['icon'] == 'fas fa-angle-double-up'){ echo 'selected'; } ?> data-select2-id="select2-data-41-a9n3">
                                                    &lt;i class="fas fa-angle-double-up"&gt;&lt;/i&gt; Angle Double Up
                                                </option>
                                                <option value="fas fa-angle-down" <?php if($info['icon'] == 'fas fa-angle-down'){ echo 'selected'; } ?> data-select2-id="select2-data-42-nbim">
                                                    &lt;i class="fas fa-angle-down"&gt;&lt;/i&gt; angle-down
                                                </option>
                                                <option value="fas fa-angle-left" <?php if($info['icon'] == 'fas fa-angle-left'){ echo 'selected'; } ?> data-select2-id="select2-data-43-h22b">
                                                    &lt;i class="fas fa-angle-left"&gt;&lt;/i&gt; angle-left
                                                </option>
                                                <option value="fas fa-angle-right" <?php if($info['icon'] == 'fas fa-angle-right'){ echo 'selected'; } ?> data-select2-id="select2-data-44-8d9p">
                                                    &lt;i class="fas fa-angle-right"&gt;&lt;/i&gt; angle-right
                                                </option>
                                                <option value="fas fa-angle-up" <?php if($info['icon'] == 'fas fa-angle-up'){ echo 'selected'; } ?> data-select2-id="select2-data-45-m6vo">
                                                    &lt;i class="fas fa-angle-up"&gt;&lt;/i&gt; angle-up
                                                </option>
                                                
                                                <option value="fab fa-angrycreative" <?php if($info['icon'] == 'fab fa-angrycreative'){ echo 'selected'; } ?> data-select2-id="select2-data-47-04dh">
                                                    &lt;i class="fab fa-angrycreative"&gt;&lt;/i&gt; Angry Creative
                                                </option>
                                                <option value="fab fa-angular" <?php if($info['icon'] == 'fab fa-angular'){ echo 'selected'; } ?> data-select2-id="select2-data-48-fijt">
                                                    &lt;i class="fab fa-angular"&gt;&lt;/i&gt; Angular
                                                </option>
  
                                                <option value="fab fa-app-store" <?php if($info['icon'] == 'fab fa-app-store'){ echo 'selected'; } ?> data-select2-id="select2-data-50-dmip">
                                                    &lt;i class="fab fa-app-store"&gt;&lt;/i&gt; App Store
                                                </option>
                                                <option value="fab fa-app-store-ios" <?php if($info['icon'] == 'fab fa-app-store-ios'){ echo 'selected'; } ?> data-select2-id="select2-data-51-jh6n">
                                                    &lt;i class="fab fa-app-store-ios"&gt;&lt;/i&gt; iOS App Store
                                                </option>
                                                <option value="fab fa-apper" <?php if($info['icon'] == 'fab fa-apper'){ echo 'selected'; } ?> data-select2-id="select2-data-52-bliu">
                                                    &lt;i class="fab fa-apper"&gt;&lt;/i&gt; Apper Systems AB
                                                </option>
                                                <option value="fab fa-apple" <?php if($info['icon'] == 'fab fa-apple'){ echo 'selected'; } ?> data-select2-id="select2-data-53-or9n">
                                                    &lt;i class="fab fa-apple"&gt;&lt;/i&gt; Apple
                                                </option>
                                                <option value="fab fa-apple-pay" <?php if($info['icon'] == 'fab fa-apple-pay'){ echo 'selected'; } ?> data-select2-id="select2-data-55-trab">
                                                    &lt;i class="fab fa-apple-pay"&gt;&lt;/i&gt; Apple Pay
                                                </option>
                                                <option value="fas fa-archive" <?php if($info['icon'] == 'fas fa-archive'){ echo 'selected'; } ?> data-select2-id="select2-data-56-hwbe">
                                                    &lt;i class="fas fa-archive"&gt;&lt;/i&gt; Archive
                                                </option>
                                                <option value="fas fa-arrow-alt-circle-down" <?php if($info['icon'] == 'fas fa-arrow-alt-circle-down'){ echo 'selected'; } ?> data-select2-id="select2-data-58-aruc">
                                                    &lt;i class="fas fa-arrow-alt-circle-down"&gt;&lt;/i&gt; Alternate Arrow Circle Down
                                                </option>
                                                <option value="fas fa-arrow-alt-circle-left" <?php if($info['icon'] == 'fas fa-arrow-alt-circle-left'){ echo 'selected'; } ?> data-select2-id="select2-data-59-d15u">
                                                    &lt;i class="fas fa-arrow-alt-circle-left"&gt;&lt;/i&gt; Alternate Arrow Circle Left
                                                </option>
                                                <option value="fas fa-arrow-alt-circle-right" <?php if($info['icon'] == 'fas fa-arrow-alt-circle-right'){ echo 'selected'; } ?> data-select2-id="select2-data-60-zzge">
                                                    &lt;i class="fas fa-arrow-alt-circle-right"&gt;&lt;/i&gt; Alternate Arrow Circle Right
                                                </option>
                                                <option value="fas fa-arrow-alt-circle-up" <?php if($info['icon'] == 'fas fa-arrow-alt-circle-up'){ echo 'selected'; } ?> data-select2-id="select2-data-61-jai7">
                                                    &lt;i class="fas fa-arrow-alt-circle-up"&gt;&lt;/i&gt; Alternate Arrow Circle Up
                                                </option>
                                                <option value="fas fa-arrow-circle-down" <?php if($info['icon'] == 'fas fa-arrow-circle-down'){ echo 'selected'; } ?> data-select2-id="select2-data-62-fuw9">
                                                    &lt;i class="fas fa-arrow-circle-down"&gt;&lt;/i&gt; Arrow Circle Down
                                                </option>
                                                <option value="fas fa-arrow-circle-left" <?php if($info['icon'] == 'fas fa-arrow-circle-left'){ echo 'selected'; } ?> data-select2-id="select2-data-63-3em5">
                                                    &lt;i class="fas fa-arrow-circle-left"&gt;&lt;/i&gt; Arrow Circle Left
                                                </option>
                                                <option value="fas fa-arrow-circle-right" <?php if($info['icon'] == 'fas fa-arrow-circle-right'){ echo 'selected'; } ?> data-select2-id="select2-data-64-wuze">
                                                    &lt;i class="fas fa-arrow-circle-right"&gt;&lt;/i&gt; Arrow Circle Right
                                                </option>
                                                <option value="fas fa-arrow-circle-up" <?php if($info['icon'] == 'fas fa-arrow-circle-up'){ echo 'selected'; } ?> data-select2-id="select2-data-65-hls0">
                                                    &lt;i class="fas fa-arrow-circle-up"&gt;&lt;/i&gt; Arrow Circle Up
                                                </option>
                                                <option value="fas fa-arrow-down" <?php if($info['icon'] == 'fas fa-arrow-down'){ echo 'selected'; } ?> data-select2-id="select2-data-66-c61z">
                                                    &lt;i class="fas fa-arrow-down"&gt;&lt;/i&gt; arrow-down
                                                </option>
                                                <option value="fas fa-arrow-left" <?php if($info['icon'] == 'fas fa-arrow-left'){ echo 'selected'; } ?> data-select2-id="select2-data-67-gpkw">
                                                    &lt;i class="fas fa-arrow-left"&gt;&lt;/i&gt; arrow-left
                                                </option>
                                                <option value="fas fa-arrow-right" <?php if($info['icon'] == 'fas fa-arrow-right'){ echo 'selected'; } ?> data-select2-id="select2-data-68-1oxz">
                                                    &lt;i class="fas fa-arrow-right"&gt;&lt;/i&gt; arrow-right
                                                </option>
                                                <option value="fas fa-arrow-up" <?php if($info['icon'] == 'fas fa-arrow-up'){ echo 'selected'; } ?> data-select2-id="select2-data-69-wbk9">
                                                    &lt;i class="fas fa-arrow-up"&gt;&lt;/i&gt; arrow-up
                                                </option>
                                                <option value="fas fa-arrows-alt" <?php if($info['icon'] == 'fas fa-arrows-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-70-0u48">
                                                    &lt;i class="fas fa-arrows-alt"&gt;&lt;/i&gt; Alternate Arrows
                                                </option>
                                                <option value="fas fa-arrows-alt-h" <?php if($info['icon'] == 'fas fa-arrows-alt-h'){ echo 'selected'; } ?> data-select2-id="select2-data-71-9fb8">
                                                    &lt;i class="fas fa-arrows-alt-h"&gt;&lt;/i&gt; Alternate Arrows Horizontal
                                                </option>
                                                <option value="fas fa-arrows-alt-v" <?php if($info['icon'] == 'fas fa-arrows-alt-v'){ echo 'selected'; } ?> data-select2-id="select2-data-72-wd6p">
                                                    &lt;i class="fas fa-arrows-alt-v"&gt;&lt;/i&gt; Alternate Arrows Vertical
                                                </option>
                                                <option value="fas fa-assistive-listening-systems" <?php if($info['icon'] == 'fas fa-assistive-listening-systems'){ echo 'selected'; } ?> data-select2-id="select2-data-74-mz3d">
                                                    &lt;i class="fas fa-assistive-listening-systems"&gt;&lt;/i&gt; Assistive Listening Systems
                                                </option>
                                                <option value="fas fa-asterisk" <?php if($info['icon'] == 'fas fa-asterisk'){ echo 'selected'; } ?> data-select2-id="select2-data-75-qxb2">
                                                    &lt;i class="fas fa-asterisk"&gt;&lt;/i&gt; asterisk
                                                </option>
                                                <option value="fab fa-asymmetrik" <?php if($info['icon'] == 'fab fa-asymmetrik'){ echo 'selected'; } ?> data-select2-id="select2-data-76-p4rr">
                                                    &lt;i class="fab fa-asymmetrik"&gt;&lt;/i&gt; Asymmetrik, Ltd.
                                                </option>
                                                <option value="fas fa-at" <?php if($info['icon'] == 'fas fa-at'){ echo 'selected'; } ?> data-select2-id="select2-data-77-5ni5">
                                                    &lt;i class="fas fa-at"&gt;&lt;/i&gt; At
                                                </option>
                                                <option value="fab fa-audible" <?php if($info['icon'] == 'fab fa-audible'){ echo 'selected'; } ?> data-select2-id="select2-data-81-argq">
                                                    &lt;i class="fab fa-audible"&gt;&lt;/i&gt; Audible
                                                </option>
                                                <option value="fas fa-audio-description" <?php if($info['icon'] == 'fas fa-audio-description'){ echo 'selected'; } ?> data-select2-id="select2-data-82-qrci">
                                                    &lt;i class="fas fa-audio-description"&gt;&lt;/i&gt; Audio Description
                                                </option>
                                                <option value="fab fa-autoprefixer" <?php if($info['icon'] == 'fab fa-autoprefixer'){ echo 'selected'; } ?> data-select2-id="select2-data-83-n06q">
                                                    &lt;i class="fab fa-autoprefixer"&gt;&lt;/i&gt; Autoprefixer
                                                </option>
                                                <option value="fab fa-avianex" <?php if($info['icon'] == 'fab fa-avianex'){ echo 'selected'; } ?> data-select2-id="select2-data-84-t3k2">
                                                    &lt;i class="fab fa-avianex"&gt;&lt;/i&gt; avianex
                                                </option>
                                                <option value="fab fa-aviato" <?php if($info['icon'] == 'fab fa-aviato'){ echo 'selected'; } ?> data-select2-id="select2-data-85-83j0">
                                                    &lt;i class="fab fa-aviato"&gt;&lt;/i&gt; Aviato
                                                </option>
                                                <option value="fab fa-aws" <?php if($info['icon'] == 'fab fa-aws'){ echo 'selected'; } ?> data-select2-id="select2-data-87-0sds">
                                                    &lt;i class="fab fa-aws"&gt;&lt;/i&gt; Amazon Web Services (AWS)
                                                </option>
                                                <option value="fas fa-backward" <?php if($info['icon'] == 'fas fa-backward'){ echo 'selected'; } ?> data-select2-id="select2-data-91-7jz1">
                                                    &lt;i class="fas fa-backward"&gt;&lt;/i&gt; backward
                                                </option>
                                                <option value="fas fa-balance-scale" <?php if($info['icon'] == 'fas fa-balance-scale'){ echo 'selected'; } ?> data-select2-id="select2-data-96-8csm">
                                                    &lt;i class="fas fa-balance-scale"&gt;&lt;/i&gt; Balance Scale
                                                </option>
                                                <option value="fas fa-ban" <?php if($info['icon'] == 'fas fa-ban'){ echo 'selected'; } ?> data-select2-id="select2-data-99-imh8">
                                                    &lt;i class="fas fa-ban"&gt;&lt;/i&gt; ban
                                                </option>
                                                <option value="fas fa-band-aid" <?php if($info['icon'] == 'fas fa-band-aid'){ echo 'selected'; } ?> data-select2-id="select2-data-100-ubwx">
                                                    &lt;i class="fas fa-band-aid"&gt;&lt;/i&gt; Band-Aid
                                                </option>
                                                <option value="fab fa-bandcamp" <?php if($info['icon'] == 'fab fa-bandcamp'){ echo 'selected'; } ?> data-select2-id="select2-data-101-0u04">
                                                    &lt;i class="fab fa-bandcamp"&gt;&lt;/i&gt; Bandcamp
                                                </option>
                                                <option value="fas fa-barcode" <?php if($info['icon'] == 'fas fa-barcode'){ echo 'selected'; } ?> data-select2-id="select2-data-102-ykrs">
                                                    &lt;i class="fas fa-barcode"&gt;&lt;/i&gt; barcode
                                                </option>
                                                <option value="fas fa-bars" <?php if($info['icon'] == 'fas fa-bars'){ echo 'selected'; } ?> data-select2-id="select2-data-103-8syx">
                                                    &lt;i class="fas fa-bars"&gt;&lt;/i&gt; Bars
                                                </option>
                                                <option value="fas fa-baseball-ball" <?php if($info['icon'] == 'fas fa-baseball-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-104-iuka">
                                                    &lt;i class="fas fa-baseball-ball"&gt;&lt;/i&gt; Baseball Ball
                                                </option>
                                                <option value="fas fa-basketball-ball" <?php if($info['icon'] == 'fas fa-basketball-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-105-o0pn">
                                                    &lt;i class="fas fa-basketball-ball"&gt;&lt;/i&gt; Basketball Ball
                                                </option>
                                                <option value="fas fa-bath" <?php if($info['icon'] == 'fas fa-bath'){ echo 'selected'; } ?> data-select2-id="select2-data-106-iz1j">
                                                    &lt;i class="fas fa-bath"&gt;&lt;/i&gt; Bath
                                                </option>
                                                <option value="fas fa-battery-empty" <?php if($info['icon'] == 'fas fa-battery-empty'){ echo 'selected'; } ?> data-select2-id="select2-data-107-gzwn">
                                                    &lt;i class="fas fa-battery-empty"&gt;&lt;/i&gt; Battery Empty
                                                </option>
                                                <option value="fas fa-battery-full" <?php if($info['icon'] == 'fas fa-battery-full'){ echo 'selected'; } ?> data-select2-id="select2-data-108-plez">
                                                    &lt;i class="fas fa-battery-full"&gt;&lt;/i&gt; Battery Full
                                                </option>
                                                <option value="fas fa-battery-half" <?php if($info['icon'] == 'fas fa-battery-half'){ echo 'selected'; } ?> data-select2-id="select2-data-109-3sjo">
                                                    &lt;i class="fas fa-battery-half"&gt;&lt;/i&gt; Battery 1/2 Full
                                                </option>
                                                <option value="fas fa-battery-quarter" <?php if($info['icon'] == 'fas fa-battery-quarter'){ echo 'selected'; } ?> data-select2-id="select2-data-110-vcoj">
                                                    &lt;i class="fas fa-battery-quarter"&gt;&lt;/i&gt; Battery 1/4 Full
                                                </option>
                                                <option value="fas fa-battery-three-quarters" <?php if($info['icon'] == 'fas fa-battery-three-quarters'){ echo 'selected'; } ?> data-select2-id="select2-data-111-9co3">
                                                    &lt;i class="fas fa-battery-three-quarters"&gt;&lt;/i&gt; Battery 3/4 Full
                                                </option>
                                                <option value="fas fa-bed" <?php if($info['icon'] == 'fas fa-bed'){ echo 'selected'; } ?> data-select2-id="select2-data-113-j0j6">
                                                    &lt;i class="fas fa-bed"&gt;&lt;/i&gt; Bed
                                                </option>
                                                <option value="fas fa-beer" <?php if($info['icon'] == 'fas fa-beer'){ echo 'selected'; } ?> data-select2-id="select2-data-114-vp4h">
                                                    &lt;i class="fas fa-beer"&gt;&lt;/i&gt; beer
                                                </option>
                                                <option value="fab fa-behance" <?php if($info['icon'] == 'fab fa-behance'){ echo 'selected'; } ?> data-select2-id="select2-data-115-ruyd">
                                                    &lt;i class="fab fa-behance"&gt;&lt;/i&gt; Behance
                                                </option>
                                                <option value="fab fa-behance-square" <?php if($info['icon'] == 'fab fa-behance-square'){ echo 'selected'; } ?> data-select2-id="select2-data-116-pfor">
                                                    &lt;i class="fab fa-behance-square"&gt;&lt;/i&gt; Behance Square
                                                </option>
                                                <option value="fas fa-bell" <?php if($info['icon'] == 'fas fa-bell'){ echo 'selected'; } ?> data-select2-id="select2-data-117-dqbv">
                                                    &lt;i class="fas fa-bell"&gt;&lt;/i&gt; bell
                                                </option>
                                                <option value="fas fa-bell-slash" <?php if($info['icon'] == 'fas fa-bell-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-118-tn3h">
                                                    &lt;i class="fas fa-bell-slash"&gt;&lt;/i&gt; Bell Slash
                                                </option>
                                                <option value="fas fa-bicycle" <?php if($info['icon'] == 'fas fa-bicycle'){ echo 'selected'; } ?> data-select2-id="select2-data-121-99bt">
                                                    &lt;i class="fas fa-bicycle"&gt;&lt;/i&gt; Bicycle
                                                </option>
                                                <option value="fab fa-bimobject" <?php if($info['icon'] == 'fab fa-bimobject'){ echo 'selected'; } ?> data-select2-id="select2-data-123-v4t8">
                                                    &lt;i class="fab fa-bimobject"&gt;&lt;/i&gt; BIMobject
                                                </option>
                                                <option value="fas fa-binoculars" <?php if($info['icon'] == 'fas fa-binoculars'){ echo 'selected'; } ?> data-select2-id="select2-data-124-gu0d">
                                                    &lt;i class="fas fa-binoculars"&gt;&lt;/i&gt; Binoculars
                                                </option>
                                                <option value="fas fa-birthday-cake" <?php if($info['icon'] == 'fas fa-birthday-cake'){ echo 'selected'; } ?> data-select2-id="select2-data-126-ab8n">
                                                    &lt;i class="fas fa-birthday-cake"&gt;&lt;/i&gt; Birthday Cake
                                                </option>
                                                <option value="fab fa-bitbucket" <?php if($info['icon'] == 'fab fa-bitbucket'){ echo 'selected'; } ?> data-select2-id="select2-data-127-fb5y">
                                                    &lt;i class="fab fa-bitbucket"&gt;&lt;/i&gt; Bitbucket
                                                </option>
                                                <option value="fab fa-bitcoin" <?php if($info['icon'] == 'fab fa-bitcoin'){ echo 'selected'; } ?> data-select2-id="select2-data-128-m20n">
                                                    &lt;i class="fab fa-bitcoin"&gt;&lt;/i&gt; Bitcoin
                                                </option>
                                                <option value="fab fa-bity" <?php if($info['icon'] == 'fab fa-bity'){ echo 'selected'; } ?> data-select2-id="select2-data-129-30mf">
                                                    &lt;i class="fab fa-bity"&gt;&lt;/i&gt; Bity
                                                </option>
                                                <option value="fab fa-black-tie" <?php if($info['icon'] == 'fab fa-black-tie'){ echo 'selected'; } ?> data-select2-id="select2-data-130-g7nd">
                                                    &lt;i class="fab fa-black-tie"&gt;&lt;/i&gt; Font Awesome Black Tie
                                                </option>
                                                <option value="fab fa-blackberry" <?php if($info['icon'] == 'fab fa-blackberry'){ echo 'selected'; } ?> data-select2-id="select2-data-131-ish5">
                                                    &lt;i class="fab fa-blackberry"&gt;&lt;/i&gt; BlackBerry
                                                </option>
                                                <option value="fas fa-blender" <?php if($info['icon'] == 'fas fa-blender'){ echo 'selected'; } ?> data-select2-id="select2-data-132-c30y">
                                                    &lt;i class="fas fa-blender"&gt;&lt;/i&gt; Blender
                                                </option>
                                                <option value="fas fa-blind" <?php if($info['icon'] == 'fas fa-blind'){ echo 'selected'; } ?> data-select2-id="select2-data-134-gf13">
                                                    &lt;i class="fas fa-blind"&gt;&lt;/i&gt; Blind
                                                </option>
                                                <option value="fab fa-blogger" <?php if($info['icon'] == 'fab fa-blogger'){ echo 'selected'; } ?> data-select2-id="select2-data-136-m4dj">
                                                    &lt;i class="fab fa-blogger"&gt;&lt;/i&gt; Blogger
                                                </option>
                                                <option value="fab fa-blogger-b" <?php if($info['icon'] == 'fab fa-blogger-b'){ echo 'selected'; } ?> data-select2-id="select2-data-137-dyh3">
                                                    &lt;i class="fab fa-blogger-b"&gt;&lt;/i&gt; Blogger B
                                                </option>
                                                <option value="fab fa-bluetooth" <?php if($info['icon'] == 'fab fa-bluetooth'){ echo 'selected'; } ?> data-select2-id="select2-data-138-325w">
                                                    &lt;i class="fab fa-bluetooth"&gt;&lt;/i&gt; Bluetooth
                                                </option>
                                                <option value="fab fa-bluetooth-b" <?php if($info['icon'] == 'fab fa-bluetooth-b'){ echo 'selected'; } ?> data-select2-id="select2-data-139-6h1j">
                                                    &lt;i class="fab fa-bluetooth-b"&gt;&lt;/i&gt; Bluetooth
                                                </option>
                                                <option value="fas fa-bold" <?php if($info['icon'] == 'fas fa-bold'){ echo 'selected'; } ?> data-select2-id="select2-data-140-st47">
                                                    &lt;i class="fas fa-bold"&gt;&lt;/i&gt; bold
                                                </option>
                                                <option value="fas fa-bolt" <?php if($info['icon'] == 'fas fa-bolt'){ echo 'selected'; } ?> data-select2-id="select2-data-141-puqz">
                                                    &lt;i class="fas fa-bolt"&gt;&lt;/i&gt; Lightning Bolt
                                                </option>
                                                <option value="fas fa-bomb" <?php if($info['icon'] == 'fas fa-bomb'){ echo 'selected'; } ?> data-select2-id="select2-data-142-7ai9">
                                                    &lt;i class="fas fa-bomb"&gt;&lt;/i&gt; Bomb
                                                </option>
                                                <option value="fas fa-book" <?php if($info['icon'] == 'fas fa-book'){ echo 'selected'; } ?> data-select2-id="select2-data-145-kn4u">
                                                    &lt;i class="fas fa-book"&gt;&lt;/i&gt; book
                                                </option>
                                                <option value="fas fa-book-open" <?php if($info['icon'] == 'fas fa-book-open'){ echo 'selected'; } ?> data-select2-id="select2-data-148-2mjt">
                                                    &lt;i class="fas fa-book-open"&gt;&lt;/i&gt; Book Open
                                                </option>
                                                <option value="fas fa-bookmark" <?php if($info['icon'] == 'fas fa-bookmark'){ echo 'selected'; } ?> data-select2-id="select2-data-150-w9zs">
                                                    &lt;i class="fas fa-bookmark"&gt;&lt;/i&gt; bookmark
                                                </option>
                                                <option value="fas fa-bowling-ball" <?php if($info['icon'] == 'fas fa-bowling-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-155-td5x">
                                                    &lt;i class="fas fa-bowling-ball"&gt;&lt;/i&gt; Bowling Ball
                                                </option>
                                                <option value="fas fa-box" <?php if($info['icon'] == 'fas fa-box'){ echo 'selected'; } ?> data-select2-id="select2-data-156-lo0g">
                                                    &lt;i class="fas fa-box"&gt;&lt;/i&gt; Box
                                                </option>
                                                <option value="fas fa-box-open" <?php if($info['icon'] == 'fas fa-box-open'){ echo 'selected'; } ?> data-select2-id="select2-data-157-8wps">
                                                    &lt;i class="fas fa-box-open"&gt;&lt;/i&gt; Box Open
                                                </option>
                                                <option value="fas fa-boxes" <?php if($info['icon'] == 'fas fa-boxes'){ echo 'selected'; } ?> data-select2-id="select2-data-159-6lto">
                                                    &lt;i class="fas fa-boxes"&gt;&lt;/i&gt; Boxes
                                                </option>
                                                <option value="fas fa-braille" <?php if($info['icon'] == 'fas fa-braille'){ echo 'selected'; } ?> data-select2-id="select2-data-160-vjtu">
                                                    &lt;i class="fas fa-braille"&gt;&lt;/i&gt; Braille
                                                </option>
                                                <option value="fas fa-briefcase" <?php if($info['icon'] == 'fas fa-briefcase'){ echo 'selected'; } ?> data-select2-id="select2-data-163-xo29">
                                                    &lt;i class="fas fa-briefcase"&gt;&lt;/i&gt; Briefcase
                                                </option>
                                                <option value="fas fa-briefcase-medical" <?php if($info['icon'] == 'fas fa-briefcase-medical'){ echo 'selected'; } ?> data-select2-id="select2-data-164-kpiz">
                                                    &lt;i class="fas fa-briefcase-medical"&gt;&lt;/i&gt; Medical Briefcase
                                                </option>
                                                <option value="fas fa-broadcast-tower" <?php if($info['icon'] == 'fas fa-broadcast-tower'){ echo 'selected'; } ?> data-select2-id="select2-data-165-rox6">
                                                    &lt;i class="fas fa-broadcast-tower"&gt;&lt;/i&gt; Broadcast Tower
                                                </option>
                                                <option value="fas fa-broom" <?php if($info['icon'] == 'fas fa-broom'){ echo 'selected'; } ?> data-select2-id="select2-data-166-ixfn">
                                                    &lt;i class="fas fa-broom"&gt;&lt;/i&gt; Broom
                                                </option>
                                                <option value="fab fa-btc" <?php if($info['icon'] == 'fab fa-btc'){ echo 'selected'; } ?> data-select2-id="select2-data-168-zd8g">
                                                    &lt;i class="fab fa-btc"&gt;&lt;/i&gt; BTC
                                                </option>
                                                <option value="fas fa-bug" <?php if($info['icon'] == 'fas fa-bug'){ echo 'selected'; } ?> data-select2-id="select2-data-170-3lrz">
                                                    &lt;i class="fas fa-bug"&gt;&lt;/i&gt; Bug
                                                </option>
                                                <option value="fas fa-building" <?php if($info['icon'] == 'fas fa-building'){ echo 'selected'; } ?> data-select2-id="select2-data-171-vde0">
                                                    &lt;i class="fas fa-building"&gt;&lt;/i&gt; Building
                                                </option>
                                                <option value="fas fa-bullhorn" <?php if($info['icon'] == 'fas fa-bullhorn'){ echo 'selected'; } ?> data-select2-id="select2-data-172-fyiu">
                                                    &lt;i class="fas fa-bullhorn"&gt;&lt;/i&gt; bullhorn
                                                </option>
                                                <option value="fas fa-bullseye" <?php if($info['icon'] == 'fas fa-bullseye'){ echo 'selected'; } ?> data-select2-id="select2-data-173-m3i4">
                                                    &lt;i class="fas fa-bullseye"&gt;&lt;/i&gt; Bullseye
                                                </option>
                                                <option value="fas fa-burn" <?php if($info['icon'] == 'fas fa-burn'){ echo 'selected'; } ?> data-select2-id="select2-data-174-j70h">
                                                    &lt;i class="fas fa-burn"&gt;&lt;/i&gt; Burn
                                                </option>
                                                <option value="fab fa-buromobelexperte" <?php if($info['icon'] == 'fab fa-buromobelexperte'){ echo 'selected'; } ?> data-select2-id="select2-data-175-ki53">
                                                    &lt;i class="fab fa-buromobelexperte"&gt;&lt;/i&gt; Büromöbel-Experte GmbH &amp; Co. KG.
                                                </option>
                                                <option value="fas fa-bus" <?php if($info['icon'] == 'fas fa-bus'){ echo 'selected'; } ?> data-select2-id="select2-data-176-dmkz">
                                                    &lt;i class="fas fa-bus"&gt;&lt;/i&gt; Bus
                                                </option>
                                                <option value="fab fa-buysellads" <?php if($info['icon'] == 'fab fa-buysellads'){ echo 'selected'; } ?> data-select2-id="select2-data-180-86qb">
                                                    &lt;i class="fab fa-buysellads"&gt;&lt;/i&gt; BuySellAds
                                                </option>
                                                <option value="fas fa-calculator" <?php if($info['icon'] == 'fas fa-calculator'){ echo 'selected'; } ?> data-select2-id="select2-data-181-t2w5">
                                                    &lt;i class="fas fa-calculator"&gt;&lt;/i&gt; Calculator
                                                </option>
                                                <option value="fas fa-calendar" <?php if($info['icon'] == 'fas fa-calendar'){ echo 'selected'; } ?> data-select2-id="select2-data-182-qsux">
                                                    &lt;i class="fas fa-calendar"&gt;&lt;/i&gt; Calendar
                                                </option>
                                                <option value="fas fa-calendar-alt" <?php if($info['icon'] == 'fas fa-calendar-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-183-95c3">
                                                    &lt;i class="fas fa-calendar-alt"&gt;&lt;/i&gt; Alternate Calendar
                                                </option>
                                                <option value="fas fa-calendar-check" <?php if($info['icon'] == 'fas fa-calendar-check'){ echo 'selected'; } ?> data-select2-id="select2-data-184-p2q4">
                                                    &lt;i class="fas fa-calendar-check"&gt;&lt;/i&gt; Calendar Check
                                                </option>
                                                <option value="fas fa-calendar-minus" <?php if($info['icon'] == 'fas fa-calendar-minus'){ echo 'selected'; } ?> data-select2-id="select2-data-186-zw7p">
                                                    &lt;i class="fas fa-calendar-minus"&gt;&lt;/i&gt; Calendar Minus
                                                </option>
                                                <option value="fas fa-calendar-plus" <?php if($info['icon'] == 'fas fa-calendar-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-187-oqky">
                                                    &lt;i class="fas fa-calendar-plus"&gt;&lt;/i&gt; Calendar Plus
                                                </option>
                                                <option value="fas fa-calendar-times" <?php if($info['icon'] == 'fas fa-calendar-times'){ echo 'selected'; } ?> data-select2-id="select2-data-188-4so4">
                                                    &lt;i class="fas fa-calendar-times"&gt;&lt;/i&gt; Calendar Times
                                                </option>
                                                <option value="fas fa-camera" <?php if($info['icon'] == 'fas fa-camera'){ echo 'selected'; } ?> data-select2-id="select2-data-190-xpjc">
                                                    &lt;i class="fas fa-camera"&gt;&lt;/i&gt; camera
                                                </option>
                                                <option value="fas fa-camera-retro" <?php if($info['icon'] == 'fas fa-camera-retro'){ echo 'selected'; } ?> data-select2-id="select2-data-191-cajn">
                                                    &lt;i class="fas fa-camera-retro"&gt;&lt;/i&gt; Retro Camera
                                                </option>
                                                <option value="fas fa-capsules" <?php if($info['icon'] == 'fas fa-capsules'){ echo 'selected'; } ?> data-select2-id="select2-data-196-99pq">
                                                    &lt;i class="fas fa-capsules"&gt;&lt;/i&gt; Capsules
                                                </option>
                                                <option value="fas fa-car" <?php if($info['icon'] == 'fas fa-car'){ echo 'selected'; } ?> data-select2-id="select2-data-197-rlr9">
                                                    &lt;i class="fas fa-car"&gt;&lt;/i&gt; Car
                                                </option>
                                                <option value="fas fa-caret-down" <?php if($info['icon'] == 'fas fa-caret-down'){ echo 'selected'; } ?> data-select2-id="select2-data-203-b32a">
                                                    &lt;i class="fas fa-caret-down"&gt;&lt;/i&gt; Caret Down
                                                </option>
                                                <option value="fas fa-caret-left" <?php if($info['icon'] == 'fas fa-caret-left'){ echo 'selected'; } ?> data-select2-id="select2-data-204-gcmm">
                                                    &lt;i class="fas fa-caret-left"&gt;&lt;/i&gt; Caret Left
                                                </option>
                                                <option value="fas fa-caret-right" <?php if($info['icon'] == 'fas fa-caret-right'){ echo 'selected'; } ?> data-select2-id="select2-data-205-y24q">
                                                    &lt;i class="fas fa-caret-right"&gt;&lt;/i&gt; Caret Right
                                                </option>
                                                <option value="fas fa-caret-square-down" <?php if($info['icon'] == 'fas fa-caret-square-down'){ echo 'selected'; } ?> data-select2-id="select2-data-206-f0a7">
                                                    &lt;i class="fas fa-caret-square-down"&gt;&lt;/i&gt; Caret Square Down
                                                </option>
                                                <option value="fas fa-caret-square-left" <?php if($info['icon'] == 'fas fa-caret-square-left'){ echo 'selected'; } ?> data-select2-id="select2-data-207-8adq">
                                                    &lt;i class="fas fa-caret-square-left"&gt;&lt;/i&gt; Caret Square Left
                                                </option>
                                                <option value="fas fa-caret-square-right" <?php if($info['icon'] == 'fas fa-caret-square-right'){ echo 'selected'; } ?> data-select2-id="select2-data-208-mqbi">
                                                    &lt;i class="fas fa-caret-square-right"&gt;&lt;/i&gt; Caret Square Right
                                                </option>
                                                <option value="fas fa-caret-square-up" <?php if($info['icon'] == 'fas fa-caret-square-up'){ echo 'selected'; } ?> data-select2-id="select2-data-209-hy9s">
                                                    &lt;i class="fas fa-caret-square-up"&gt;&lt;/i&gt; Caret Square Up
                                                </option>
                                                <option value="fas fa-caret-up" <?php if($info['icon'] == 'fas fa-caret-up'){ echo 'selected'; } ?> data-select2-id="select2-data-210-tbyf">
                                                    &lt;i class="fas fa-caret-up"&gt;&lt;/i&gt; Caret Up
                                                </option>
                                                <option value="fas fa-cart-arrow-down" <?php if($info['icon'] == 'fas fa-cart-arrow-down'){ echo 'selected'; } ?> data-select2-id="select2-data-212-55ni">
                                                    &lt;i class="fas fa-cart-arrow-down"&gt;&lt;/i&gt; Shopping Cart Arrow Down
                                                </option>
                                                <option value="fas fa-cart-plus" <?php if($info['icon'] == 'fas fa-cart-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-213-h93c">
                                                    &lt;i class="fas fa-cart-plus"&gt;&lt;/i&gt; Add to Shopping Cart
                                                </option>
                                                <option value="fab fa-cc-amazon-pay" <?php if($info['icon'] == 'fab fa-cc-amazon-pay'){ echo 'selected'; } ?> data-select2-id="select2-data-216-rlqw">
                                                    &lt;i class="fab fa-cc-amazon-pay"&gt;&lt;/i&gt; Amazon Pay Credit Card
                                                </option>
                                                <option value="fab fa-cc-amex" <?php if($info['icon'] == 'fab fa-cc-amex'){ echo 'selected'; } ?> data-select2-id="select2-data-217-rp4a">
                                                    &lt;i class="fab fa-cc-amex"&gt;&lt;/i&gt; American Express Credit Card
                                                </option>
                                                <option value="fab fa-cc-apple-pay" <?php if($info['icon'] == 'fab fa-cc-apple-pay'){ echo 'selected'; } ?> data-select2-id="select2-data-218-zmd6">
                                                    &lt;i class="fab fa-cc-apple-pay"&gt;&lt;/i&gt; Apple Pay Credit Card
                                                </option>
                                                <option value="fab fa-cc-diners-club" <?php if($info['icon'] == 'fab fa-cc-diners-club'){ echo 'selected'; } ?> data-select2-id="select2-data-219-dnbv">
                                                    &lt;i class="fab fa-cc-diners-club"&gt;&lt;/i&gt; Diner's Club Credit Card
                                                </option>
                                                <option value="fab fa-cc-discover" <?php if($info['icon'] == 'fab fa-cc-discover'){ echo 'selected'; } ?> data-select2-id="select2-data-220-seym">
                                                    &lt;i class="fab fa-cc-discover"&gt;&lt;/i&gt; Discover Credit Card
                                                </option>
                                                <option value="fab fa-cc-jcb" <?php if($info['icon'] == 'fab fa-cc-jcb'){ echo 'selected'; } ?> data-select2-id="select2-data-221-3z42">
                                                    &lt;i class="fab fa-cc-jcb"&gt;&lt;/i&gt; JCB Credit Card
                                                </option>
                                                <option value="fab fa-cc-mastercard" <?php if($info['icon'] == 'fab fa-cc-mastercard'){ echo 'selected'; } ?> data-select2-id="select2-data-222-fm0o">
                                                    &lt;i class="fab fa-cc-mastercard"&gt;&lt;/i&gt; MasterCard Credit Card
                                                </option>
                                                <option value="fab fa-cc-paypal" <?php if($info['icon'] == 'fab fa-cc-paypal'){ echo 'selected'; } ?> data-select2-id="select2-data-223-cfzd">
                                                    &lt;i class="fab fa-cc-paypal"&gt;&lt;/i&gt; Paypal Credit Card
                                                </option>
                                                <option value="fab fa-cc-stripe" <?php if($info['icon'] == 'fab fa-cc-stripe'){ echo 'selected'; } ?> data-select2-id="select2-data-224-setk">
                                                    &lt;i class="fab fa-cc-stripe"&gt;&lt;/i&gt; Stripe Credit Card
                                                </option>
                                                <option value="fab fa-cc-visa" <?php if($info['icon'] == 'fab fa-cc-visa'){ echo 'selected'; } ?> data-select2-id="select2-data-225-8zlt">
                                                    &lt;i class="fab fa-cc-visa"&gt;&lt;/i&gt; Visa Credit Card
                                                </option>
                                                <option value="fab fa-centercode" <?php if($info['icon'] == 'fab fa-centercode'){ echo 'selected'; } ?> data-select2-id="select2-data-226-sb7p">
                                                    &lt;i class="fab fa-centercode"&gt;&lt;/i&gt; Centercode
                                                </option>
                                                <option value="fas fa-certificate" <?php if($info['icon'] == 'fas fa-certificate'){ echo 'selected'; } ?> data-select2-id="select2-data-228-v8oc">
                                                    &lt;i class="fas fa-certificate"&gt;&lt;/i&gt; certificate
                                                </option>
                                                <option value="fas fa-chalkboard" <?php if($info['icon'] == 'fas fa-chalkboard'){ echo 'selected'; } ?> data-select2-id="select2-data-230-ttgz">
                                                    &lt;i class="fas fa-chalkboard"&gt;&lt;/i&gt; Chalkboard
                                                </option>
                                                <option value="fas fa-chalkboard-teacher" <?php if($info['icon'] == 'fas fa-chalkboard-teacher'){ echo 'selected'; } ?> data-select2-id="select2-data-231-uy6g">
                                                    &lt;i class="fas fa-chalkboard-teacher"&gt;&lt;/i&gt; Chalkboard Teacher
                                                </option>
                                                <option value="fas fa-chart-area" <?php if($info['icon'] == 'fas fa-chart-area'){ echo 'selected'; } ?> data-select2-id="select2-data-233-8sv8">
                                                    &lt;i class="fas fa-chart-area"&gt;&lt;/i&gt; Area Chart
                                                </option>
                                                <option value="fas fa-chart-bar" <?php if($info['icon'] == 'fas fa-chart-bar'){ echo 'selected'; } ?> data-select2-id="select2-data-234-fqyk">
                                                    &lt;i class="fas fa-chart-bar"&gt;&lt;/i&gt; Bar Chart
                                                </option>
                                                <option value="fas fa-chart-line" <?php if($info['icon'] == 'fas fa-chart-line'){ echo 'selected'; } ?> data-select2-id="select2-data-235-fhiu">
                                                    &lt;i class="fas fa-chart-line"&gt;&lt;/i&gt; Line Chart
                                                </option>
                                                <option value="fas fa-chart-pie" <?php if($info['icon'] == 'fas fa-chart-pie'){ echo 'selected'; } ?> data-select2-id="select2-data-236-rv7i">
                                                    &lt;i class="fas fa-chart-pie"&gt;&lt;/i&gt; Pie Chart
                                                </option>
                                                <option value="fas fa-check" <?php if($info['icon'] == 'fas fa-check'){ echo 'selected'; } ?> data-select2-id="select2-data-237-5u2f">
                                                    &lt;i class="fas fa-check"&gt;&lt;/i&gt; Check
                                                </option>
                                                <option value="fas fa-check-circle" <?php if($info['icon'] == 'fas fa-check-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-238-ws26">
                                                    &lt;i class="fas fa-check-circle"&gt;&lt;/i&gt; Check Circle
                                                </option>
                                                <option value="fas fa-check-square" <?php if($info['icon'] == 'fas fa-check-square'){ echo 'selected'; } ?> data-select2-id="select2-data-240-joue">
                                                    &lt;i class="fas fa-check-square"&gt;&lt;/i&gt; Check Square
                                                </option>
                                                <option value="fas fa-chess" <?php if($info['icon'] == 'fas fa-chess'){ echo 'selected'; } ?> data-select2-id="select2-data-242-35mz">
                                                    &lt;i class="fas fa-chess"&gt;&lt;/i&gt; Chess
                                                </option>
                                                <option value="fas fa-chess-bishop" <?php if($info['icon'] == 'fas fa-chess-bishop'){ echo 'selected'; } ?> data-select2-id="select2-data-243-mf1f">
                                                    &lt;i class="fas fa-chess-bishop"&gt;&lt;/i&gt; Chess Bishop
                                                </option>
                                                <option value="fas fa-chess-board" <?php if($info['icon'] == 'fas fa-chess-board'){ echo 'selected'; } ?> data-select2-id="select2-data-244-wtta">
                                                    &lt;i class="fas fa-chess-board"&gt;&lt;/i&gt; Chess Board
                                                </option>
                                                <option value="fas fa-chess-king" <?php if($info['icon'] == 'fas fa-chess-king'){ echo 'selected'; } ?> data-select2-id="select2-data-245-4g5p">
                                                    &lt;i class="fas fa-chess-king"&gt;&lt;/i&gt; Chess King
                                                </option>
                                                <option value="fas fa-chess-knight" <?php if($info['icon'] == 'fas fa-chess-knight'){ echo 'selected'; } ?> data-select2-id="select2-data-246-z932">
                                                    &lt;i class="fas fa-chess-knight"&gt;&lt;/i&gt; Chess Knight
                                                </option>
                                                <option value="fas fa-chess-pawn" <?php if($info['icon'] == 'fas fa-chess-pawn'){ echo 'selected'; } ?> data-select2-id="select2-data-247-hklr">
                                                    &lt;i class="fas fa-chess-pawn"&gt;&lt;/i&gt; Chess Pawn
                                                </option>
                                                <option value="fas fa-chess-queen" <?php if($info['icon'] == 'fas fa-chess-queen'){ echo 'selected'; } ?> data-select2-id="select2-data-248-7trh">
                                                    &lt;i class="fas fa-chess-queen"&gt;&lt;/i&gt; Chess Queen
                                                </option>
                                                <option value="fas fa-chess-rook" <?php if($info['icon'] == 'fas fa-chess-rook'){ echo 'selected'; } ?> data-select2-id="select2-data-249-2qrf">
                                                    &lt;i class="fas fa-chess-rook"&gt;&lt;/i&gt; Chess Rook
                                                </option>
                                                <option value="fas fa-chevron-circle-down" <?php if($info['icon'] == 'fas fa-chevron-circle-down'){ echo 'selected'; } ?> data-select2-id="select2-data-250-mbpo">
                                                    &lt;i class="fas fa-chevron-circle-down"&gt;&lt;/i&gt; Chevron Circle Down
                                                </option>
                                                <option value="fas fa-chevron-circle-left" <?php if($info['icon'] == 'fas fa-chevron-circle-left'){ echo 'selected'; } ?> data-select2-id="select2-data-251-orpq">
                                                    &lt;i class="fas fa-chevron-circle-left"&gt;&lt;/i&gt; Chevron Circle Left
                                                </option>
                                                <option value="fas fa-chevron-circle-right" <?php if($info['icon'] == 'fas fa-chevron-circle-right'){ echo 'selected'; } ?> data-select2-id="select2-data-252-c9wd">
                                                    &lt;i class="fas fa-chevron-circle-right"&gt;&lt;/i&gt; Chevron Circle Right
                                                </option>
                                                <option value="fas fa-chevron-circle-up" <?php if($info['icon'] == 'fas fa-chevron-circle-up'){ echo 'selected'; } ?> data-select2-id="select2-data-253-i5vw">
                                                    &lt;i class="fas fa-chevron-circle-up"&gt;&lt;/i&gt; Chevron Circle Up
                                                </option>
                                                <option value="fas fa-chevron-down" <?php if($info['icon'] == 'fas fa-chevron-down'){ echo 'selected'; } ?> data-select2-id="select2-data-254-b2l1">
                                                    &lt;i class="fas fa-chevron-down"&gt;&lt;/i&gt; chevron-down
                                                </option>
                                                <option value="fas fa-chevron-left" <?php if($info['icon'] == 'fas fa-chevron-left'){ echo 'selected'; } ?> data-select2-id="select2-data-255-s65c">
                                                    &lt;i class="fas fa-chevron-left"&gt;&lt;/i&gt; chevron-left
                                                </option>
                                                <option value="fas fa-chevron-right" <?php if($info['icon'] == 'fas fa-chevron-right'){ echo 'selected'; } ?> data-select2-id="select2-data-256-62w0">
                                                    &lt;i class="fas fa-chevron-right"&gt;&lt;/i&gt; chevron-right
                                                </option>
                                                <option value="fas fa-chevron-up" <?php if($info['icon'] == 'fas fa-chevron-up'){ echo 'selected'; } ?> data-select2-id="select2-data-257-14zf">
                                                    &lt;i class="fas fa-chevron-up"&gt;&lt;/i&gt; chevron-up
                                                </option>
                                                <option value="fas fa-child" <?php if($info['icon'] == 'fas fa-child'){ echo 'selected'; } ?> data-select2-id="select2-data-258-0x46">
                                                    &lt;i class="fas fa-child"&gt;&lt;/i&gt; Child
                                                </option>
                                                <option value="fab fa-chrome" <?php if($info['icon'] == 'fab fa-chrome'){ echo 'selected'; } ?> data-select2-id="select2-data-259-8lix">
                                                    &lt;i class="fab fa-chrome"&gt;&lt;/i&gt; Chrome
                                                </option>
                                                <option value="fas fa-church" <?php if($info['icon'] == 'fas fa-church'){ echo 'selected'; } ?> data-select2-id="select2-data-261-p0qj">
                                                    &lt;i class="fas fa-church"&gt;&lt;/i&gt; Church
                                                </option>
                                                <option value="fas fa-circle" <?php if($info['icon'] == 'fas fa-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-262-ie19">
                                                    &lt;i class="fas fa-circle"&gt;&lt;/i&gt; Circle
                                                </option>
                                                <option value="fas fa-circle-notch" <?php if($info['icon'] == 'fas fa-circle-notch'){ echo 'selected'; } ?> data-select2-id="select2-data-263-imv7">
                                                    &lt;i class="fas fa-circle-notch"&gt;&lt;/i&gt; Circle Notched
                                                </option>
                                                <option value="fas fa-clipboard" <?php if($info['icon'] == 'fas fa-clipboard'){ echo 'selected'; } ?> data-select2-id="select2-data-266-m2kw">
                                                    &lt;i class="fas fa-clipboard"&gt;&lt;/i&gt; Clipboard
                                                </option>
                                                <option value="fas fa-clipboard-check" <?php if($info['icon'] == 'fas fa-clipboard-check'){ echo 'selected'; } ?> data-select2-id="select2-data-267-9cy2">
                                                    &lt;i class="fas fa-clipboard-check"&gt;&lt;/i&gt; Clipboard with Check
                                                </option>
                                                <option value="fas fa-clipboard-list" <?php if($info['icon'] == 'fas fa-clipboard-list'){ echo 'selected'; } ?> data-select2-id="select2-data-268-j53i">
                                                    &lt;i class="fas fa-clipboard-list"&gt;&lt;/i&gt; Clipboard List
                                                </option>
                                                <option value="fas fa-clock" <?php if($info['icon'] == 'fas fa-clock'){ echo 'selected'; } ?> data-select2-id="select2-data-269-zouo">
                                                    &lt;i class="fas fa-clock"&gt;&lt;/i&gt; Clock
                                                </option>
                                                <option value="fas fa-clone" <?php if($info['icon'] == 'fas fa-clone'){ echo 'selected'; } ?> data-select2-id="select2-data-270-z3hb">
                                                    &lt;i class="fas fa-clone"&gt;&lt;/i&gt; Clone
                                                </option>
                                                <option value="fas fa-closed-captioning" <?php if($info['icon'] == 'fas fa-closed-captioning'){ echo 'selected'; } ?> data-select2-id="select2-data-271-zese">
                                                    &lt;i class="fas fa-closed-captioning"&gt;&lt;/i&gt; Closed Captioning
                                                </option>
                                                <option value="fas fa-cloud" <?php if($info['icon'] == 'fas fa-cloud'){ echo 'selected'; } ?> data-select2-id="select2-data-272-rma2">
                                                    &lt;i class="fas fa-cloud"&gt;&lt;/i&gt; Cloud
                                                </option>
                                                <option value="fas fa-cloud-download-alt" <?php if($info['icon'] == 'fas fa-cloud-download-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-273-kugr">
                                                    &lt;i class="fas fa-cloud-download-alt"&gt;&lt;/i&gt; Alternate Cloud Download
                                                </option>
                                                <option value="fas fa-cloud-upload-alt" <?php if($info['icon'] == 'fas fa-cloud-download-alt'){ echo 'selected'; } ?>  data-select2-id="select2-data-281-8rll">
                                                    &lt;i class="fas fa-cloud-upload-alt"&gt;&lt;/i&gt; Alternate Cloud Upload
                                                </option>
                                                <option value="fab fa-cloudscale" <?php if($info['icon'] == 'fab fa-cloudscale'){ echo 'selected'; } ?> data-select2-id="select2-data-283-f6a0">
                                                    &lt;i class="fab fa-cloudscale"&gt;&lt;/i&gt; cloudscale.ch
                                                </option>
                                                <option value="fab fa-cloudsmith" <?php if($info['icon'] == 'fab fa-cloudsmith'){ echo 'selected'; } ?> data-select2-id="select2-data-284-tge0">
                                                    &lt;i class="fab fa-cloudsmith"&gt;&lt;/i&gt; Cloudsmith
                                                </option>
                                                <option value="fab fa-cloudversify" <?php if($info['icon'] == 'fab fa-cloudversify'){ echo 'selected'; } ?> data-select2-id="select2-data-285-00h8">
                                                    &lt;i class="fab fa-cloudversify"&gt;&lt;/i&gt; cloudversify
                                                </option>
                                                <option value="fas fa-code" <?php if($info['icon'] == 'fas fa-code'){ echo 'selected'; } ?> data-select2-id="select2-data-287-ct3v">
                                                    &lt;i class="fas fa-code"&gt;&lt;/i&gt; Code
                                                </option>
                                                <option value="fas fa-code-branch" <?php if($info['icon'] == 'fas fa-code-branch'){ echo 'selected'; } ?> data-select2-id="select2-data-288-48cu">
                                                    &lt;i class="fas fa-code-branch"&gt;&lt;/i&gt; Code Branch
                                                </option>
                                                <option value="fab fa-codepen" <?php if($info['icon'] == 'fab fa-codepen'){ echo 'selected'; } ?> data-select2-id="select2-data-289-3qdo">
                                                    &lt;i class="fab fa-codepen"&gt;&lt;/i&gt; Codepen
                                                </option>
                                                <option value="fab fa-codiepie" <?php if($info['icon'] == 'fab fa-codiepie'){ echo 'selected'; } ?> data-select2-id="select2-data-290-axoj">
                                                    &lt;i class="fab fa-codiepie"&gt;&lt;/i&gt; Codie Pie
                                                </option>
                                                <option value="fas fa-coffee" <?php if($info['icon'] == 'fas fa-coffee'){ echo 'selected'; } ?> data-select2-id="select2-data-291-eu2n">
                                                    &lt;i class="fas fa-coffee"&gt;&lt;/i&gt; Coffee
                                                </option>
                                                <option value="fas fa-cog" <?php if($info['icon'] == 'fas fa-cog'){ echo 'selected'; } ?> data-select2-id="select2-data-292-6jx4">
                                                    &lt;i class="fas fa-cog"&gt;&lt;/i&gt; cog
                                                </option>
                                                <option value="fas fa-cogs" <?php if($info['icon'] == 'fas fa-cogs'){ echo 'selected'; } ?> data-select2-id="select2-data-293-ucto">
                                                    &lt;i class="fas fa-cogs"&gt;&lt;/i&gt; cogs
                                                </option>
                                                <option value="fas fa-coins" <?php if($info['icon'] == 'fas fa-coins'){ echo 'selected'; } ?> data-select2-id="select2-data-294-pngy">
                                                    &lt;i class="fas fa-coins"&gt;&lt;/i&gt; Coins
                                                </option>
                                                <option value="fas fa-columns" <?php if($info['icon'] == 'fas fa-columns'){ echo 'selected'; } ?> data-select2-id="select2-data-295-ejs7">
                                                    &lt;i class="fas fa-columns"&gt;&lt;/i&gt; Columns
                                                </option>
                                                <option value="fas fa-comment" <?php if($info['icon'] == 'as fa-comment'){ echo 'selected'; } ?> data-select2-id="select2-data-296-3ayw">
                                                    &lt;i class="fas fa-comment"&gt;&lt;/i&gt; comment
                                                </option>
                                                <option value="fas fa-comment-alt" <?php if($info['icon'] == 'fas fa-comment-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-297-qey8">
                                                    &lt;i class="fas fa-comment-alt"&gt;&lt;/i&gt; Alternate Comment
                                                </option>
                                                <option value="fas fa-comment-dots" <?php if($info['icon'] == 'fas fa-comment-dots'){ echo 'selected'; } ?> data-select2-id="select2-data-299-zkmr">
                                                    &lt;i class="fas fa-comment-dots"&gt;&lt;/i&gt; Comment Dots
                                                </option>
                                                <option value="fas fa-comment-slash" <?php if($info['icon'] == 'fas fa-comment-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-301-klnm">
                                                    &lt;i class="fas fa-comment-slash"&gt;&lt;/i&gt; Comment Slash
                                                </option>
                                                <option value="fas fa-comments" <?php if($info['icon'] == 'fas fa-comments'){ echo 'selected'; } ?> data-select2-id="select2-data-302-k6pk">
                                                    &lt;i class="fas fa-comments"&gt;&lt;/i&gt; comments
                                                </option>
                                                <option value="fas fa-compact-disc" <?php if($info['icon'] == 'fas fa-compact-disc'){ echo 'selected'; } ?> data-select2-id="select2-data-304-fgg8">
                                                    &lt;i class="fas fa-compact-disc"&gt;&lt;/i&gt; Compact Disc
                                                </option>
                                                <option value="fas fa-compass" <?php if($info['icon'] == 'fas fa-compass'){ echo 'selected'; } ?> data-select2-id="select2-data-305-1x18">
                                                    &lt;i class="fas fa-compass"&gt;&lt;/i&gt; Compass
                                                </option>
                                                <option value="fas fa-compress" <?php if($info['icon'] == 'fas fa-compress'){ echo 'selected'; } ?> data-select2-id="select2-data-306-zxty">
                                                    &lt;i class="fas fa-compress"&gt;&lt;/i&gt; Compress
                                                </option>
                                                <option value="fab fa-connectdevelop" <?php if($info['icon'] == 'fab fa-connectdevelop'){ echo 'selected'; } ?> data-select2-id="select2-data-311-1ic2">
                                                    &lt;i class="fab fa-connectdevelop"&gt;&lt;/i&gt; Connect Develop
                                                </option>
                                                <option value="fab fa-contao" <?php if($info['icon'] == 'fab fa-contao'){ echo 'selected'; } ?> data-select2-id="select2-data-312-d9kt">
                                                    &lt;i class="fab fa-contao"&gt;&lt;/i&gt; Contao
                                                </option>
                                                <option value="fas fa-copy" <?php if($info['icon'] == 'fas fa-copy'){ echo 'selected'; } ?> data-select2-id="select2-data-315-fi1a">
                                                    &lt;i class="fas fa-copy"&gt;&lt;/i&gt; Copy
                                                </option>
                                                <option value="fas fa-copyright" <?php if($info['icon'] == 'fas fa-copyright'){ echo 'selected'; } ?> data-select2-id="select2-data-316-7wz2">
                                                    &lt;i class="fas fa-copyright"&gt;&lt;/i&gt; Copyright
                                                </option>
                                                <option value="fas fa-couch" <?php if($info['icon'] == 'fas fa-couch'){ echo 'selected'; } ?> data-select2-id="select2-data-318-cv8m">
                                                    &lt;i class="fas fa-couch"&gt;&lt;/i&gt; Couch
                                                </option>
                                                <option value="fab fa-cpanel" <?php if($info['icon'] == 'fab fa-cpanel'){ echo 'selected'; } ?> data-select2-id="select2-data-319-m363">
                                                    &lt;i class="fab fa-cpanel"&gt;&lt;/i&gt; cPanel
                                                </option>
                                                <option value="fab fa-creative-commons" <?php if($info['icon'] == 'fab fa-creative-commons'){ echo 'selected'; } ?> data-select2-id="select2-data-320-bjfv">
                                                    &lt;i class="fab fa-creative-commons"&gt;&lt;/i&gt; Creative Commons
                                                </option>
                                                <option value="fab fa-creative-commons-by" <?php if($info['icon'] == 'fab fa-creative-commons-by'){ echo 'selected'; } ?> data-select2-id="select2-data-321-qmz4">
                                                    &lt;i class="fab fa-creative-commons-by"&gt;&lt;/i&gt; Creative Commons Attribution
                                                </option>
                                                <option value="fab fa-creative-commons-nc" <?php if($info['icon'] == 'fab fa-creative-commons-nc'){ echo 'selected'; } ?> data-select2-id="select2-data-322-ncj0">
                                                    &lt;i class="fab fa-creative-commons-nc"&gt;&lt;/i&gt; Creative Commons Noncommercial
                                                </option>
                                                <option value="fab fa-creative-commons-nc-eu" <?php if($info['icon'] == 'fab fa-creative-commons-nc-eu'){ echo 'selected'; } ?> data-select2-id="select2-data-323-6ul4">
                                                    &lt;i class="fab fa-creative-commons-nc-eu"&gt;&lt;/i&gt; Creative Commons Noncommercial (Euro Sign)
                                                </option>
                                                <option value="fab fa-creative-commons-nc-jp" <?php if($info['icon'] == 'fab fa-creative-commons-nc-jp'){ echo 'selected'; } ?> data-select2-id="select2-data-324-xduo">
                                                    &lt;i class="fab fa-creative-commons-nc-jp"&gt;&lt;/i&gt; Creative Commons Noncommercial (Yen Sign)
                                                </option>
                                                <option value="fab fa-creative-commons-nd" <?php if($info['icon'] == 'fab fa-creative-commons-nd'){ echo 'selected'; } ?> data-select2-id="select2-data-325-s20o">
                                                    &lt;i class="fab fa-creative-commons-nd"&gt;&lt;/i&gt; Creative Commons No Derivative Works
                                                </option>
                                                <option value="fab fa-creative-commons-pd" <?php if($info['icon'] == 'fab fa-creative-commons-pd'){ echo 'selected'; } ?> data-select2-id="select2-data-326-nayw">
                                                    &lt;i class="fab fa-creative-commons-pd"&gt;&lt;/i&gt; Creative Commons Public Domain
                                                </option>
                                                <option value="fab fa-creative-commons-pd-alt" <?php if($info['icon'] == 'fab fa-creative-commons-pd-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-327-iqt8">
                                                    &lt;i class="fab fa-creative-commons-pd-alt"&gt;&lt;/i&gt; Alternate Creative Commons Public Domain
                                                </option>
                                                <option value="fab fa-creative-commons-remix" <?php if($info['icon'] == 'fab fa-creative-commons-remix'){ echo 'selected'; } ?> data-select2-id="select2-data-328-8gue">
                                                    &lt;i class="fab fa-creative-commons-remix"&gt;&lt;/i&gt; Creative Commons Remix
                                                </option>
                                                <option value="fab fa-creative-commons-sa" <?php if($info['icon'] == 'fab fa-creative-commons-sa'){ echo 'selected'; } ?> data-select2-id="select2-data-329-uk4v">
                                                    &lt;i class="fab fa-creative-commons-sa"&gt;&lt;/i&gt; Creative Commons Share Alike
                                                </option>
                                                <option value="fab fa-creative-commons-sampling" <?php if($info['icon'] == 'fab fa-creative-commons-sampling'){ echo 'selected'; } ?> data-select2-id="select2-data-330-1m8c">
                                                    &lt;i class="fab fa-creative-commons-sampling"&gt;&lt;/i&gt; Creative Commons Sampling
                                                </option>
                                                <option value="fab fa-creative-commons-sampling-plus" <?php if($info['icon'] == 'fab fa-creative-commons-sampling-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-331-ermr">
                                                    &lt;i class="fab fa-creative-commons-sampling-plus"&gt;&lt;/i&gt; Creative Commons Sampling +
                                                </option>
                                                <option value="fab fa-creative-commons-share" <?php if($info['icon'] == 'fab fa-creative-commons-share'){ echo 'selected'; } ?> data-select2-id="select2-data-332-ee5t">
                                                    &lt;i class="fab fa-creative-commons-share"&gt;&lt;/i&gt; Creative Commons Share
                                                </option>
                                                <option value="fas fa-credit-card" <?php if($info['icon'] == 'fas fa-credit-card'){ echo 'selected'; } ?> data-select2-id="select2-data-334-g7dc">
                                                    &lt;i class="fas fa-credit-card"&gt;&lt;/i&gt; Credit Card
                                                </option>
                                                <option value="fas fa-crop" <?php if($info['icon'] == 'fas fa-crop'){ echo 'selected'; } ?> data-select2-id="select2-data-336-p8p9">
                                                    &lt;i class="fas fa-crop"&gt;&lt;/i&gt; crop
                                                </option> 
                                                <option value="fas fa-crosshairs" <?php if($info['icon'] == 'fas fa-crosshairs'){ echo 'selected'; } ?> data-select2-id="select2-data-339-4eot">
                                                    &lt;i class="fas fa-crosshairs"&gt;&lt;/i&gt; Crosshairs
                                                </option>
                                                <option value="fas fa-crow" <?php if($info['icon'] == 'fas fa-crow'){ echo 'selected'; } ?> data-select2-id="select2-data-340-325h">
                                                    &lt;i class="fas fa-crow"&gt;&lt;/i&gt; Crow
                                                </option>
                                                <option value="fas fa-crown" <?php if($info['icon'] == 'fas fa-crown'){ echo 'selected'; } ?> data-select2-id="select2-data-341-2qqw">
                                                    &lt;i class="fas fa-crown"&gt;&lt;/i&gt; Crown
                                                </option>
                                                <option value="fab fa-css3" <?php if($info['icon'] == 'fab fa-css3'){ echo 'selected'; } ?> data-select2-id="select2-data-343-kifi">
                                                    &lt;i class="fab fa-css3"&gt;&lt;/i&gt; CSS 3 Logo
                                                </option>
                                                <option value="fab fa-css3-alt" <?php if($info['icon'] == 'fab fa-css3-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-344-snxg">
                                                    &lt;i class="fab fa-css3-alt"&gt;&lt;/i&gt; Alternate CSS3 Logo
                                                </option>
                                                <option value="fas fa-cube" <?php if($info['icon'] == 'fas fa-cube'){ echo 'selected'; } ?> data-select2-id="select2-data-345-2t94">
                                                    &lt;i class="fas fa-cube"&gt;&lt;/i&gt; Cube
                                                </option>
                                                <option value="fas fa-cubes" <?php if($info['icon'] == 'fas fa-cubes'){ echo 'selected'; } ?> data-select2-id="select2-data-346-m8n2">
                                                    &lt;i class="fas fa-cubes"&gt;&lt;/i&gt; Cubes
                                                </option>
                                                <option value="fas fa-cut" <?php if($info['icon'] == 'fas fa-cut'){ echo 'selected'; } ?> data-select2-id="select2-data-347-pipy">
                                                    &lt;i class="fas fa-cut"&gt;&lt;/i&gt; Cut
                                                </option>
                                                <option value="fab fa-cuttlefish" <?php if($info['icon'] == 'fab fa-cuttlefish'){ echo 'selected'; } ?> data-select2-id="select2-data-348-ivin">
                                                    &lt;i class="fab fa-cuttlefish"&gt;&lt;/i&gt; Cuttlefish
                                                </option>
                                                <option value="fab fa-d-and-d" <?php if($info['icon'] == 'fab fa-d-and-d'){ echo 'selected'; } ?> data-select2-id="select2-data-349-0aqm">
                                                    &lt;i class="fab fa-d-and-d"&gt;&lt;/i&gt; Dungeons &amp; Dragons
                                                </option>
                                                <option value="fab fa-dashcube" <?php if($info['icon'] == 'fab fa-dashcube'){ echo 'selected'; } ?> data-select2-id="select2-data-352-fprs">
                                                    &lt;i class="fab fa-dashcube"&gt;&lt;/i&gt; DashCube
                                                </option>
                                                <option value="fas fa-database" <?php if($info['icon'] == 'fas fa-database'){ echo 'selected'; } ?> data-select2-id="select2-data-353-dsm5">
                                                    &lt;i class="fas fa-database"&gt;&lt;/i&gt; Database
                                                </option>
                                                <option value="fas fa-deaf" <?php if($info['icon'] == 'fas fa-deaf'){ echo 'selected'; } ?> data-select2-id="select2-data-354-xwmj">
                                                    &lt;i class="fas fa-deaf"&gt;&lt;/i&gt; Deaf
                                                </option>
                                                <option value="fab fa-delicious" <?php if($info['icon'] == 'fab fa-delicious'){ echo 'selected'; } ?> data-select2-id="select2-data-356-yqri">
                                                    &lt;i class="fab fa-delicious"&gt;&lt;/i&gt; Delicious
                                                </option>
                                                <option value="fab fa-deploydog" <?php if($info['icon'] == 'fab fa-deploydog'){ echo 'selected'; } ?> data-select2-id="select2-data-358-h44j">
                                                    &lt;i class="fab fa-deploydog"&gt;&lt;/i&gt; deploy.dog
                                                </option>
                                                <option value="fab fa-deskpro" <?php if($info['icon'] == 'fab fa-deskpro'){ echo 'selected'; } ?> data-select2-id="select2-data-359-f8v2">
                                                    &lt;i class="fab fa-deskpro"&gt;&lt;/i&gt; Deskpro
                                                </option>
                                                <option value="fas fa-desktop" <?php if($info['icon'] == 'fas fa-desktop'){ echo 'selected'; } ?> data-select2-id="select2-data-360-e7vr">
                                                    &lt;i class="fas fa-desktop"&gt;&lt;/i&gt; Desktop
                                                </option>
                                                <option value="fab fa-deviantart" <?php if($info['icon'] == 'fab fa-deviantart'){ echo 'selected'; } ?> data-select2-id="select2-data-362-d8s1">
                                                    &lt;i class="fab fa-deviantart"&gt;&lt;/i&gt; deviantART
                                                </option>
                                                <option value="fas fa-diagnoses" <?php if($info['icon'] == 'fas fa-diagnoses'){ echo 'selected'; } ?> data-select2-id="select2-data-365-me5f">
                                                    &lt;i class="fas fa-diagnoses"&gt;&lt;/i&gt; Diagnoses
                                                </option>
                                                <option value="fas fa-dice" <?php if($info['icon'] == 'fas fa-dice'){ echo 'selected'; } ?> data-select2-id="select2-data-367-19xj">
                                                    &lt;i class="fas fa-dice"&gt;&lt;/i&gt; Dice
                                                </option>
                                                <option value="fas fa-dice-five" <?php if($info['icon'] == 'fas fa-dice-five'){ echo 'selected'; } ?> data-select2-id="select2-data-370-0445">
                                                    &lt;i class="fas fa-dice-five"&gt;&lt;/i&gt; Dice Five
                                                </option>
                                                <option value="fas fa-dice-four" <?php if($info['icon'] == 'fas fa-dice-four'){ echo 'selected'; } ?> data-select2-id="select2-data-371-9g39">
                                                    &lt;i class="fas fa-dice-four"&gt;&lt;/i&gt; Dice Four
                                                </option>
                                                <option value="fas fa-dice-one" <?php if($info['icon'] == 'fas fa-dice-one'){ echo 'selected'; } ?> data-select2-id="select2-data-372-wkks">
                                                    &lt;i class="fas fa-dice-one"&gt;&lt;/i&gt; Dice One
                                                </option>
                                                <option value="fas fa-dice-six" <?php if($info['icon'] == 'fas fa-dice-six'){ echo 'selected'; } ?> data-select2-id="select2-data-373-kgsp">
                                                    &lt;i class="fas fa-dice-six"&gt;&lt;/i&gt; Dice Six
                                                </option>
                                                <option value="fas fa-dice-three" <?php if($info['icon'] == 'fas fa-dice-three'){ echo 'selected'; } ?> data-select2-id="select2-data-374-nlot">
                                                    &lt;i class="fas fa-dice-three"&gt;&lt;/i&gt; Dice Three
                                                </option>
                                                <option value="fas fa-dice-two" <?php if($info['icon'] == 'fas fa-dice-two'){ echo 'selected'; } ?> data-select2-id="select2-data-375-majc">
                                                    &lt;i class="fas fa-dice-two"&gt;&lt;/i&gt; Dice Two
                                                </option>
                                                <option value="fab fa-digg" <?php if($info['icon'] == 'fab fa-digg'){ echo 'selected'; } ?> data-select2-id="select2-data-376-i20x">
                                                    &lt;i class="fab fa-digg"&gt;&lt;/i&gt; Digg Logo
                                                </option>
                                                <option value="fab fa-digital-ocean" <?php if($info['icon'] == 'fab fa-digital-ocean'){ echo 'selected'; } ?> data-select2-id="select2-data-377-2p5g">
                                                    &lt;i class="fab fa-digital-ocean"&gt;&lt;/i&gt; Digital Ocean
                                                </option>
                                                <option value="fab fa-discord" <?php if($info['icon'] == 'fab fa-discord'){ echo 'selected'; } ?> data-select2-id="select2-data-380-srn4">
                                                    &lt;i class="fab fa-discord"&gt;&lt;/i&gt; Discord
                                                </option>
                                                <option value="fab fa-discourse" <?php if($info['icon'] == 'fab fa-discourse'){ echo 'selected'; } ?> data-select2-id="select2-data-381-vhia">
                                                    &lt;i class="fab fa-discourse"&gt;&lt;/i&gt; Discourse
                                                </option>
                                                <option value="fas fa-divide" <?php if($info['icon'] == 'fas fa-divide'){ echo 'selected'; } ?> data-select2-id="select2-data-383-of96">
                                                    &lt;i class="fas fa-divide"&gt;&lt;/i&gt; Divide
                                                </option>
                                                <option value="fas fa-dna" <?php if($info['icon'] == 'fas fa-dna'){ echo 'selected'; } ?> data-select2-id="select2-data-385-j08y">
                                                    &lt;i class="fas fa-dna"&gt;&lt;/i&gt; DNA
                                                </option>
                                                <option value="fab fa-dochub" <?php if($info['icon'] == 'fab fa-dochub'){ echo 'selected'; } ?> data-select2-id="select2-data-386-1rne">
                                                    &lt;i class="fab fa-dochub"&gt;&lt;/i&gt; DocHub
                                                </option>
                                                <option value="fab fa-docker" <?php if($info['icon'] == 'fab fa-docker'){ echo 'selected'; } ?> data-select2-id="select2-data-387-0ywe">
                                                    &lt;i class="fab fa-docker"&gt;&lt;/i&gt; Docker
                                                </option>
                                                <option value="fas fa-dollar-sign" <?php if($info['icon'] == 'fas fa-dollar-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-389-3j1t">
                                                    &lt;i class="fas fa-dollar-sign"&gt;&lt;/i&gt; Dollar Sign
                                                </option>
                                                <option value="fas fa-dolly" <?php if($info['icon'] == 'fas fa-dolly'){ echo 'selected'; } ?> data-select2-id="select2-data-390-rgbp">
                                                    &lt;i class="fas fa-dolly"&gt;&lt;/i&gt; Dolly
                                                </option>
                                                <option value="fas fa-dolly-flatbed" <?php if($info['icon'] == 'fas fa-dolly-flatbed'){ echo 'selected'; } ?> data-select2-id="select2-data-391-649z">
                                                    &lt;i class="fas fa-dolly-flatbed"&gt;&lt;/i&gt; Dolly Flatbed
                                                </option>
                                                <option value="fas fa-donate" <?php if($info['icon'] == 'fas fa-donate'){ echo 'selected'; } ?> data-select2-id="select2-data-392-66bg">
                                                    &lt;i class="fas fa-donate"&gt;&lt;/i&gt; Donate
                                                </option>
                                                <option value="fas fa-door-closed" <?php if($info['icon'] == 'fas fa-door-closed'){ echo 'selected'; } ?> data-select2-id="select2-data-393-bnl2">
                                                    &lt;i class="fas fa-door-closed"&gt;&lt;/i&gt; Door Closed
                                                </option>
                                                <option value="fas fa-door-open" <?php if($info['icon'] == 'fas fa-door-open'){ echo 'selected'; } ?> data-select2-id="select2-data-394-r6vu">
                                                    &lt;i class="fas fa-door-open"&gt;&lt;/i&gt; Door Open
                                                </option>
                                                <option value="fas fa-dot-circle" <?php if($info['icon'] == 'fas fa-dot-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-395-mcln">
                                                    &lt;i class="fas fa-dot-circle"&gt;&lt;/i&gt; Dot Circle
                                                </option>
                                                <option value="fas fa-dove" <?php if($info['icon'] == 'fas fa-dove'){ echo 'selected'; } ?> data-select2-id="select2-data-396-xmuj">
                                                    &lt;i class="fas fa-dove"&gt;&lt;/i&gt; Dove
                                                </option>
                                                <option value="fas fa-download" <?php if($info['icon'] == 'fas fa-download'){ echo 'selected'; } ?> data-select2-id="select2-data-397-zhu6">
                                                    &lt;i class="fas fa-download"&gt;&lt;/i&gt; Download
                                                </option>
                                                <option value="fab fa-draft2digital" <?php if($info['icon'] == 'fab fa-draft2digital'){ echo 'selected'; } ?> data-select2-id="select2-data-398-didq">
                                                    &lt;i class="fab fa-draft2digital"&gt;&lt;/i&gt; Draft2digital
                                                </option>
                                                <option value="fab fa-dribbble" <?php if($info['icon'] == 'fab fa-dribbble'){ echo 'selected'; } ?> data-select2-id="select2-data-402-f12z">
                                                    &lt;i class="fab fa-dribbble"&gt;&lt;/i&gt; Dribbble
                                                </option>
                                                <option value="fab fa-dribbble-square" <?php if($info['icon'] == 'fab fa-dribbble-square'){ echo 'selected'; } ?> data-select2-id="select2-data-403-yo3f">
                                                    &lt;i class="fab fa-dribbble-square"&gt;&lt;/i&gt; Dribbble Square
                                                </option>
                                                <option value="fab fa-dropbox" <?php if($info['icon'] == 'fab fa-dropbox'){ echo 'selected'; } ?> data-select2-id="select2-data-404-v0qh">
                                                    &lt;i class="fab fa-dropbox"&gt;&lt;/i&gt; Dropbox
                                                </option>
                                                <option value="fab fa-drupal" <?php if($info['icon'] == 'fab fa-drupal'){ echo 'selected'; } ?> data-select2-id="select2-data-408-d0yl">
                                                    &lt;i class="fab fa-drupal"&gt;&lt;/i&gt; Drupal Logo
                                                </option>
                                                <option value="fas fa-dumbbell" <?php if($info['icon'] == 'fas fa-dumbbell'){ echo 'selected'; } ?> data-select2-id="select2-data-409-efuq">
                                                    &lt;i class="fas fa-dumbbell"&gt;&lt;/i&gt; Dumbbell
                                                </option>
                                                <option value="fab fa-dyalog" <?php if($info['icon'] == 'fab fa-dyalog'){ echo 'selected'; } ?> data-select2-id="select2-data-413-2rbg">
                                                    &lt;i class="fab fa-dyalog"&gt;&lt;/i&gt; Dyalog
                                                </option>
                                                <option value="fab fa-earlybirds" <?php if($info['icon'] == 'fab fa-earlybirds'){ echo 'selected'; } ?> data-select2-id="select2-data-414-a2cp">
                                                    &lt;i class="fab fa-earlybirds"&gt;&lt;/i&gt; Earlybirds
                                                </option>
                                                <option value="fab fa-ebay" <?php if($info['icon'] == 'fab fa-ebay'){ echo 'selected'; } ?> data-select2-id="select2-data-415-el4b">
                                                    &lt;i class="fab fa-ebay"&gt;&lt;/i&gt; eBay
                                                </option>
                                                <option value="fab fa-edge" <?php if($info['icon'] == 'fab fa-edge'){ echo 'selected'; } ?> data-select2-id="select2-data-416-leqm">
                                                    &lt;i class="fab fa-edge"&gt;&lt;/i&gt; Edge Browser
                                                </option>
                                                <option value="fas fa-edit" <?php if($info['icon'] == 'fas fa-edit'){ echo 'selected'; } ?> data-select2-id="select2-data-418-j6u0">
                                                    &lt;i class="fas fa-edit"&gt;&lt;/i&gt; Edit
                                                </option>
                                                <option value="fas fa-eject" <?php if($info['icon'] == 'fas fa-eject'){ echo 'selected'; } ?> data-select2-id="select2-data-420-3pbk">
                                                    &lt;i class="fas fa-eject"&gt;&lt;/i&gt; eject
                                                </option>
                                                <option value="fab fa-elementor" <?php if($info['icon'] == 'fab fa-elementor'){ echo 'selected'; } ?> data-select2-id="select2-data-421-pt3g">
                                                    &lt;i class="fab fa-elementor"&gt;&lt;/i&gt; Elementor
                                                </option>
                                                <option value="fas fa-ellipsis-h" <?php if($info['icon'] == 'fas fa-ellipsis-h'){ echo 'selected'; } ?> data-select2-id="select2-data-422-oq50">
                                                    &lt;i class="fas fa-ellipsis-h"&gt;&lt;/i&gt; Horizontal Ellipsis
                                                </option>
                                                <option value="fas fa-ellipsis-v" <?php if($info['icon'] == 'fas fa-ellipsis-v'){ echo 'selected'; } ?> data-select2-id="select2-data-423-ngd8">
                                                    &lt;i class="fas fa-ellipsis-v"&gt;&lt;/i&gt; Vertical Ellipsis
                                                </option>
                                                <option value="fab fa-ember" <?php if($info['icon'] == 'fab fa-ember'){ echo 'selected'; } ?> data-select2-id="select2-data-425-9cwy">
                                                    &lt;i class="fab fa-ember"&gt;&lt;/i&gt; Ember
                                                </option>
                                                <option value="fab fa-empire" <?php if($info['icon'] == 'fab fa-empire'){ echo 'selected'; } ?> data-select2-id="select2-data-426-1ac5">
                                                    &lt;i class="fab fa-empire"&gt;&lt;/i&gt; Galactic Empire
                                                </option>
                                                <option value="fas fa-envelope" <?php if($info['icon'] == 'fas fa-envelope'){ echo 'selected'; } ?> data-select2-id="select2-data-427-bkfo">
                                                    &lt;i class="fas fa-envelope"&gt;&lt;/i&gt; Envelope
                                                </option>
                                                <option value="fas fa-envelope-open" <?php if($info['icon'] == 'fas fa-envelope-open'){ echo 'selected'; } ?> data-select2-id="select2-data-428-2b9r">
                                                    &lt;i class="fas fa-envelope-open"&gt;&lt;/i&gt; Envelope Open
                                                </option>
                                                <option value="fas fa-envelope-square" <?php if($info['icon'] == 'fas fa-envelope-square'){ echo 'selected'; } ?> data-select2-id="select2-data-430-jise">
                                                    &lt;i class="fas fa-envelope-square"&gt;&lt;/i&gt; Envelope Square
                                                </option>
                                                <option value="fab fa-envira" <?php if($info['icon'] == 'fab fa-envira'){ echo 'selected'; } ?> data-select2-id="select2-data-431-7l89">
                                                    &lt;i class="fab fa-envira"&gt;&lt;/i&gt; Envira Gallery
                                                </option>
                                                <option value="fas fa-equals" <?php if($info['icon'] == 'fas fa-equals'){ echo 'selected'; } ?> data-select2-id="select2-data-432-ve9u">
                                                    &lt;i class="fas fa-equals"&gt;&lt;/i&gt; Equals
                                                </option>
                                                <option value="fas fa-eraser" <?php if($info['icon'] == 'fas fa-eraser'){ echo 'selected'; } ?> data-select2-id="select2-data-433-inkm">
                                                    &lt;i class="fas fa-eraser"&gt;&lt;/i&gt; eraser
                                                </option>
                                                <option value="fab fa-erlang" <?php if($info['icon'] == 'fab fa-erlang'){ echo 'selected'; } ?> data-select2-id="select2-data-434-gq1i">
                                                    &lt;i class="fab fa-erlang"&gt;&lt;/i&gt; Erlang
                                                </option>
                                                <option value="fab fa-ethereum" <?php if($info['icon'] == 'fab fa-ethereum'){ echo 'selected'; } ?> data-select2-id="select2-data-435-4h0c">
                                                    &lt;i class="fab fa-ethereum"&gt;&lt;/i&gt; Ethereum
                                                </option>
                                                <option value="fab fa-etsy" <?php if($info['icon'] == 'fab fa-etsy'){ echo 'selected'; } ?> data-select2-id="select2-data-437-tiuj">
                                                    &lt;i class="fab fa-etsy"&gt;&lt;/i&gt; Etsy
                                                </option>
                                                <option value="fas fa-euro-sign" <?php if($info['icon'] == 'fas fa-euro-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-438-md12">
                                                    &lt;i class="fas fa-euro-sign"&gt;&lt;/i&gt; Euro Sign
                                                </option>
                                                <option value="fas fa-exchange-alt" <?php if($info['icon'] == 'fas fa-exchange-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-440-m40r">
                                                    &lt;i class="fas fa-exchange-alt"&gt;&lt;/i&gt; Alternate Exchange
                                                </option>
                                                <option value="fas fa-exclamation" <?php if($info['icon'] == 'fas fa-exclamation'){ echo 'selected'; } ?> data-select2-id="select2-data-441-osze">
                                                    &lt;i class="fas fa-exclamation"&gt;&lt;/i&gt; exclamation
                                                </option>
                                                <option value="fas fa-exclamation-circle" <?php if($info['icon'] == 'fas fa-exclamation-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-442-nvdk">
                                                    &lt;i class="fas fa-exclamation-circle"&gt;&lt;/i&gt; Exclamation Circle
                                                </option>
                                                <option value="fas fa-exclamation-triangle" <?php if($info['icon'] == 'fas fa-exclamation-triangle'){ echo 'selected'; } ?> data-select2-id="select2-data-443-z86p">
                                                    &lt;i class="fas fa-exclamation-triangle"&gt;&lt;/i&gt; Exclamation Triangle
                                                </option>
                                                <option value="fas fa-expand" <?php if($info['icon'] == 'fas fa-expand'){ echo 'selected'; } ?> data-select2-id="select2-data-444-m16n">
                                                    &lt;i class="fas fa-expand"&gt;&lt;/i&gt; Expand
                                                </option>
                                                <option value="fas fa-expand-arrows-alt" <?php if($info['icon'] == 'fas fa-expand-arrows-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-446-l13e">
                                                    &lt;i class="fas fa-expand-arrows-alt"&gt;&lt;/i&gt; Alternate Expand Arrows
                                                </option>
                                                <option value="fab fa-expeditedssl" <?php if($info['icon'] == 'fab fa-expeditedssl'){ echo 'selected'; } ?> data-select2-id="select2-data-447-d0ju">
                                                    &lt;i class="fab fa-expeditedssl"&gt;&lt;/i&gt; ExpeditedSSL
                                                </option>
                                                <option value="fas fa-external-link-alt" <?php if($info['icon'] == 'fas fa-external-link-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-448-z18o">
                                                    &lt;i class="fas fa-external-link-alt"&gt;&lt;/i&gt; Alternate External Link
                                                </option>
                                                <option value="fas fa-external-link-square-alt" <?php if($info['icon'] == 'fas fa-external-link-square-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-449-bl1q">
                                                    &lt;i class="fas fa-external-link-square-alt"&gt;&lt;/i&gt; Alternate
                                                    External Link Square
                                                </option>
                                                <option value="fas fa-eye" <?php if($info['icon'] == 'fas fa-eye'){ echo 'selected'; } ?> data-select2-id="select2-data-450-5hib">
                                                    &lt;i class="fas fa-eye"&gt;&lt;/i&gt; Eye
                                                </option>
                                                <option value="fas fa-eye-dropper" <?php if($info['icon'] == 'fas fa-eye-dropper'){ echo 'selected'; } ?> data-select2-id="select2-data-451-iagy">
                                                    &lt;i class="fas fa-eye-dropper"&gt;&lt;/i&gt; Eye Dropper
                                                </option>
                                                <option value="fas fa-eye-slash" <?php if($info['icon'] == 'fas fa-eye-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-452-0hgc">
                                                    &lt;i class="fas fa-eye-slash"&gt;&lt;/i&gt; Eye Slash
                                                </option>
                                                <option value="fab fa-facebook" <?php if($info['icon'] == 'fab fa-facebook'){ echo 'selected'; } ?> data-select2-id="select2-data-453-2yio">
                                                    &lt;i class="fab fa-facebook"&gt;&lt;/i&gt; Facebook
                                                </option>
                                                <option value="fab fa-facebook-f" <?php if($info['icon'] == 'fab fa-facebook-f'){ echo 'selected'; } ?> data-select2-id="select2-data-454-xmps">
                                                    &lt;i class="fab fa-facebook-f"&gt;&lt;/i&gt; Facebook F
                                                </option>
                                                <option value="fab fa-facebook-messenger" <?php if($info['icon'] == 'fab fa-facebook-messenger'){ echo 'selected'; } ?> data-select2-id="select2-data-455-t79p">
                                                    &lt;i class="fab fa-facebook-messenger"&gt;&lt;/i&gt; Facebook Messenger
                                                </option>
                                                <option value="fab fa-facebook-square" <?php if($info['icon'] == 'fab fa-facebook-square'){ echo 'selected'; } ?> data-select2-id="select2-data-456-6mnz">
                                                    &lt;i class="fab fa-facebook-square"&gt;&lt;/i&gt; Facebook Square
                                                </option>
                                                <option value="fas fa-fast-backward" <?php if($info['icon'] == 'fas fa-fast-backward'){ echo 'selected'; } ?> data-select2-id="select2-data-459-hkd7">
                                                    &lt;i class="fas fa-fast-backward"&gt;&lt;/i&gt; fast-backward
                                                </option>
                                                <option value="fas fa-fast-forward" <?php if($info['icon'] == 'fas fa-fast-forward'){ echo 'selected'; } ?> data-select2-id="select2-data-460-9zhc">
                                                    &lt;i class="fas fa-fast-forward"&gt;&lt;/i&gt; fast-forward
                                                </option>
                                                <option value="fas fa-fax" <?php if($info['icon'] == 'fas fa-fax'){ echo 'selected'; } ?> data-select2-id="select2-data-462-ctb7">
                                                    &lt;i class="fas fa-fax"&gt;&lt;/i&gt; Fax
                                                </option>
                                                <option value="fas fa-feather" <?php if($info['icon'] == 'fas fa-feather'){ echo 'selected'; } ?> data-select2-id="select2-data-463-wifg">
                                                    &lt;i class="fas fa-feather"&gt;&lt;/i&gt; Feather
                                                </option>
                                                <option value="fas fa-female" <?php if($info['icon'] == 'fas fa-female'){ echo 'selected'; } ?> data-select2-id="select2-data-467-57z9">
                                                    &lt;i class="fas fa-female"&gt;&lt;/i&gt; Female
                                                </option>
                                                <option value="fas fa-fighter-jet" <?php if($info['icon'] == 'fas fa-fighter-jet'){ echo 'selected'; } ?> data-select2-id="select2-data-468-g2c6">
                                                    &lt;i class="fas fa-fighter-jet"&gt;&lt;/i&gt; fighter-jet
                                                </option>
                                                <option value="fas fa-file" <?php if($info['icon'] == 'fas fa-file'){ echo 'selected'; } ?> data-select2-id="select2-data-470-6oas">
                                                    &lt;i class="fas fa-file"&gt;&lt;/i&gt; File
                                                </option>
                                                <option value="fas fa-file-alt" <?php if($info['icon'] == 'fas fa-file-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-471-ng74">
                                                    &lt;i class="fas fa-file-alt"&gt;&lt;/i&gt; Alternate File
                                                </option>
                                                <option value="fas fa-file-archive" <?php if($info['icon'] == 'fas fa-file-archive'){ echo 'selected'; } ?> data-select2-id="select2-data-472-feev">
                                                    &lt;i class="fas fa-file-archive"&gt;&lt;/i&gt; Archive File
                                                </option>
                                                <option value="fas fa-file-audio" <?php if($info['icon'] == 'fas fa-file-audio'){ echo 'selected'; } ?> data-select2-id="select2-data-473-ik2b">
                                                    &lt;i class="fas fa-file-audio"&gt;&lt;/i&gt; Audio File
                                                </option>
                                                <option value="fas fa-file-code" <?php if($info['icon'] == 'fas fa-file-code'){ echo 'selected'; } ?> data-select2-id="select2-data-474-6bj3">
                                                    &lt;i class="fas fa-file-code"&gt;&lt;/i&gt; Code File
                                                </option>
                                                <option value="fas fa-file-excel" <?php if($info['icon'] == 'fas fa-file-excel'){ echo 'selected'; } ?> data-select2-id="select2-data-478-q5fu">
                                                    &lt;i class="fas fa-file-excel"&gt;&lt;/i&gt; Excel File
                                                </option>
                                                <option value="fas fa-file-image" <?php if($info['icon'] == 'fas fa-file-image'){ echo 'selected'; } ?> data-select2-id="select2-data-480-nq04">
                                                    &lt;i class="fas fa-file-image"&gt;&lt;/i&gt; Image File
                                                </option>
                                                <option value="fas fa-file-medical" <?php if($info['icon'] == 'fas fa-file-medical'){ echo 'selected'; } ?> data-select2-id="select2-data-484-tggl">
                                                    &lt;i class="fas fa-file-medical"&gt;&lt;/i&gt; Medical File
                                                </option>
                                                <option value="fas fa-file-medical-alt" <?php if($info['icon'] == 'fas fa-file-medical-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-485-3fvr">
                                                    &lt;i class="fas fa-file-medical-alt"&gt;&lt;/i&gt; Alternate Medical File
                                                </option>
                                                <option value="fas fa-file-pdf" <?php if($info['icon'] == 'fas fa-file-pdf'){ echo 'selected'; } ?> data-select2-id="select2-data-486-dphk">
                                                    &lt;i class="fas fa-file-pdf"&gt;&lt;/i&gt; PDF File
                                                </option>
                                                <option value="fas fa-file-powerpoint" <?php if($info['icon'] == 'fas fa-file-powerpoint'){ echo 'selected'; } ?> data-select2-id="select2-data-487-t7b2">
                                                    &lt;i class="fas fa-file-powerpoint"&gt;&lt;/i&gt; Powerpoint File
                                                </option>
                                                <option value="fas fa-file-video" <?php if($info['icon'] == 'fas fa-file-video'){ echo 'selected'; } ?> data-select2-id="select2-data-491-xg2f">
                                                    &lt;i class="fas fa-file-video"&gt;&lt;/i&gt; Video File
                                                </option>
                                                <option value="fas fa-file-word" <?php if($info['icon'] == 'fas fa-file-word'){ echo 'selected'; } ?> data-select2-id="select2-data-492-bfme">
                                                    &lt;i class="fas fa-file-word"&gt;&lt;/i&gt; Word File
                                                </option>
                                                <option value="fas fa-film" <?php if($info['icon'] == 'fas fa-film'){ echo 'selected'; } ?> data-select2-id="select2-data-495-1jiq">
                                                    &lt;i class="fas fa-film"&gt;&lt;/i&gt; Film
                                                </option>
                                                <option value="fas fa-filter" <?php if($info['icon'] == 'fas fa-filter'){ echo 'selected'; } ?> data-select2-id="select2-data-496-qqd2">
                                                    &lt;i class="fas fa-filter"&gt;&lt;/i&gt; Filter
                                                </option>
                                                <option value="fas fa-fire" <?php if($info['icon'] == 'fas fa-fire'){ echo 'selected'; } ?> data-select2-id="select2-data-498-985j">
                                                    &lt;i class="fas fa-fire"&gt;&lt;/i&gt; fire
                                                </option>
                                                <option value="fas fa-fire-extinguisher" <?php if($info['icon'] == 'fas fa-fire-extinguisher'){ echo 'selected'; } ?> data-select2-id="select2-data-500-ntcl">
                                                    &lt;i class="fas fa-fire-extinguisher"&gt;&lt;/i&gt; fire-extinguisher
                                                </option>
                                                <option value="fab fa-firefox" <?php if($info['icon'] == 'fab fa-firefox'){ echo 'selected'; } ?> data-select2-id="select2-data-501-2n5b">
                                                    &lt;i class="fab fa-firefox"&gt;&lt;/i&gt; Firefox
                                                </option>
                                                <option value="fas fa-first-aid" <?php if($info['icon'] == 'fas fa-first-aid'){ echo 'selected'; } ?> data-select2-id="select2-data-503-i85d">
                                                    &lt;i class="fas fa-first-aid"&gt;&lt;/i&gt; First Aid
                                                </option>
                                                <option value="fab fa-first-order" <?php if($info['icon'] == 'fab fa-first-order'){ echo 'selected'; } ?> data-select2-id="select2-data-504-8qum">
                                                    &lt;i class="fab fa-first-order"&gt;&lt;/i&gt; First Order
                                                </option>
                                                <option value="fab fa-first-order-alt" <?php if($info['icon'] == 'fab fa-first-order-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-505-489u">
                                                    &lt;i class="fab fa-first-order-alt"&gt;&lt;/i&gt; Alternate First Order
                                                </option>
                                                <option value="fab fa-firstdraft" <?php if($info['icon'] == 'fab fa-firstdraft'){ echo 'selected'; } ?> data-select2-id="select2-data-506-tsmn">
                                                    &lt;i class="fab fa-firstdraft"&gt;&lt;/i&gt; firstdraft
                                                </option>
                                                <option value="fas fa-flag" <?php if($info['icon'] == 'fas fa-flag'){ echo 'selected'; } ?> data-select2-id="select2-data-509-38kl">
                                                    &lt;i class="fas fa-flag"&gt;&lt;/i&gt; flag
                                                </option>
                                                <option value="fas fa-flag-checkered" <?php if($info['icon'] == 'fas fa-flag-checkered'){ echo 'selected'; } ?> data-select2-id="select2-data-510-da2f">
                                                    &lt;i class="fas fa-flag-checkered"&gt;&lt;/i&gt; flag-checkered
                                                </option>
                                                <option value="fas fa-flask" <?php if($info['icon'] == 'fas fa-flask'){ echo 'selected'; } ?> data-select2-id="select2-data-512-hbpr">
                                                    &lt;i class="fas fa-flask"&gt;&lt;/i&gt; Flask
                                                </option>
                                                <option value="fab fa-flickr" <?php if($info['icon'] == 'fab fa-flickr'){ echo 'selected'; } ?> data-select2-id="select2-data-513-7qja">
                                                    &lt;i class="fab fa-flickr"&gt;&lt;/i&gt; Flickr
                                                </option>
                                                <option value="fab fa-flipboard" <?php if($info['icon'] == 'fab fa-flipboard'){ echo 'selected'; } ?> data-select2-id="select2-data-514-wvrg">
                                                    &lt;i class="fab fa-flipboard"&gt;&lt;/i&gt; Flipboard
                                                </option>
                                                <option value="fab fa-fly" <?php if($info['icon'] == 'fab fa-fly'){ echo 'selected'; } ?> data-select2-id="select2-data-516-bdvr">
                                                    &lt;i class="fab fa-fly"&gt;&lt;/i&gt; Fly
                                                </option>
                                                <option value="fas fa-folder" <?php if($info['icon'] == 'fas fa-folder'){ echo 'selected'; } ?> data-select2-id="select2-data-517-fec7">
                                                    &lt;i class="fas fa-folder"&gt;&lt;/i&gt; Folder
                                                </option>
                                                <option value="fas fa-folder-open" <?php if($info['icon'] == 'fas fa-folder-open'){ echo 'selected'; } ?> data-select2-id="select2-data-519-1t15">
                                                    &lt;i class="fas fa-folder-open"&gt;&lt;/i&gt; Folder Open
                                                </option>
                                                <option value="fas fa-font" <?php if($info['icon'] == 'fas fa-font'){ echo 'selected'; } ?> data-select2-id="select2-data-521-c2zw">
                                                    &lt;i class="fas fa-font"&gt;&lt;/i&gt; font
                                                </option>
                                                <option value="fab fa-font-awesome" <?php if($info['icon'] == 'fab fa-font-awesome'){ echo 'selected'; } ?> data-select2-id="select2-data-522-4yea">
                                                    &lt;i class="fab fa-font-awesome"&gt;&lt;/i&gt; Font Awesome
                                                </option>
                                                <option value="fab fa-font-awesome-alt" <?php if($info['icon'] == 'fab fa-font-awesome-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-523-h1vu">
                                                    &lt;i class="fab fa-font-awesome-alt"&gt;&lt;/i&gt; Alternate Font Awesome
                                                </option>
                                                <option value="fab fa-font-awesome-flag" <?php if($info['icon'] == 'fab fa-font-awesome-flag'){ echo 'selected'; } ?> data-select2-id="select2-data-524-2ylx">
                                                    &lt;i class="fab fa-font-awesome-flag"&gt;&lt;/i&gt; Font Awesome Flag
                                                </option>
                                                <option value="fas fa-font-awesome-logo-full" <?php if($info['icon'] == 'fas fa-font-awesome-logo-full'){ echo 'selected'; } ?> data-select2-id="select2-data-525-701q">
                                                    &lt;i class="fas fa-font-awesome-logo-full"&gt;&lt;/i&gt; Font Awesome Full Logo
                                                </option>
                                                <option value="fab fa-fonticons" <?php if($info['icon'] == 'fab fa-fonticons'){ echo 'selected'; } ?> data-select2-id="select2-data-526-wkp5">
                                                    &lt;i class="fab fa-fonticons"&gt;&lt;/i&gt; Fonticons
                                                </option>
                                                <option value="fab fa-fonticons-fi" <?php if($info['icon'] == 'fab fa-fonticons-fi'){ echo 'selected'; } ?> data-select2-id="select2-data-527-by0r">
                                                    &lt;i class="fab fa-fonticons-fi"&gt;&lt;/i&gt; Fonticons Fi
                                                </option>
                                                <option value="fas fa-football-ball" <?php if($info['icon'] == 'fas fa-football-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-528-tcxq">
                                                    &lt;i class="fas fa-football-ball"&gt;&lt;/i&gt; Football Ball
                                                </option>fab fa-fort-awesome
                                                <option value="fab fa-fort-awesome" <?php if($info['icon'] == 'fab fa-fort-awesome'){ echo 'selected'; } ?> data-select2-id="select2-data-529-5qfm">
                                                    &lt;i class="fab fa-fort-awesome"&gt;&lt;/i&gt; Fort Awesome
                                                </option>
                                                <option value="fab fa-fort-awesome-alt" <?php if($info['icon'] == 'fab fa-fort-awesome-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-530-sghq">
                                                    &lt;i class="fab fa-fort-awesome-alt"&gt;&lt;/i&gt; Alternate Fort Awesome
                                                </option>
                                                <option value="fab fa-forumbee" <?php if($info['icon'] == 'fab fa-forumbee'){ echo 'selected'; } ?> data-select2-id="select2-data-531-at5j">
                                                    &lt;i class="fab fa-forumbee"&gt;&lt;/i&gt; Forumbee
                                                </option>
                                                <option value="fas fa-forward" <?php if($info['icon'] == 'fas fa-forward'){ echo 'selected'; } ?> data-select2-id="select2-data-532-4z8m">
                                                    &lt;i class="fas fa-forward"&gt;&lt;/i&gt; forward
                                                </option>
                                                <option value="fab fa-foursquare" <?php if($info['icon'] == 'fab fa-foursquare'){ echo 'selected'; } ?> data-select2-id="select2-data-533-0f3r">
                                                    &lt;i class="fab fa-foursquare"&gt;&lt;/i&gt; Foursquare
                                                </option>
                                                <option value="fab fa-free-code-camp" <?php if($info['icon'] == 'fab fa-free-code-camp'){ echo 'selected'; } ?> data-select2-id="select2-data-534-s6td">
                                                    &lt;i class="fab fa-free-code-camp"&gt;&lt;/i&gt; freeCodeCamp
                                                </option>
                                                <option value="fab fa-freebsd" <?php if($info['icon'] == 'fab fa-freebsd'){ echo 'selected'; } ?> data-select2-id="select2-data-535-ju6y">
                                                    &lt;i class="fab fa-freebsd"&gt;&lt;/i&gt; FreeBSD
                                                </option>
                                                <option value="fas fa-frog" <?php if($info['icon'] == 'fas fa-frog'){ echo 'selected'; } ?> data-select2-id="select2-data-536-blgq">
                                                    &lt;i class="fas fa-frog"&gt;&lt;/i&gt; Frog
                                                </option>
                                                <option value="fas fa-frown" <?php if($info['icon'] == 'fas fa-frown'){ echo 'selected'; } ?> data-select2-id="select2-data-537-m84v">
                                                    &lt;i class="fas fa-frown"&gt;&lt;/i&gt; Frowning Face
                                                </option>
                                                <option value="fab fa-fulcrum" <?php if($info['icon'] == 'fab fa-fulcrum'){ echo 'selected'; } ?> data-select2-id="select2-data-539-q5ie">
                                                    &lt;i class="fab fa-fulcrum"&gt;&lt;/i&gt; Fulcrum
                                                </option>
                                                <option value="fas fa-futbol" <?php if($info['icon'] == 'fas fa-futbol'){ echo 'selected'; } ?> data-select2-id="select2-data-541-0kka">
                                                    &lt;i class="fas fa-futbol"&gt;&lt;/i&gt; Futbol
                                                </option>
                                                <option value="fab fa-galactic-republic" <?php if($info['icon'] == 'fab fa-galactic-republic'){ echo 'selected'; } ?> data-select2-id="select2-data-542-1kym">
                                                    &lt;i class="fab fa-galactic-republic"&gt;&lt;/i&gt; Galactic Republic
                                                </option>
                                                <option value="fab fa-galactic-senate" <?php if($info['icon'] == 'fab fa-galactic-senate'){ echo 'selected'; } ?> data-select2-id="select2-data-543-0b33">
                                                    &lt;i class="fab fa-galactic-senate"&gt;&lt;/i&gt; Galactic Senate
                                                </option>
                                                <option value="fas fa-gamepad" <?php if($info['icon'] == 'fas fa-gamepad'){ echo 'selected'; } ?> data-select2-id="select2-data-544-j773">
                                                    &lt;i class="fas fa-gamepad"&gt;&lt;/i&gt; Gamepad
                                                </option>
                                                <option value="fas fa-gas-pump" <?php if($info['icon'] == 'fas fa-gas-pump'){ echo 'selected'; } ?> data-select2-id="select2-data-545-76w2">
                                                    &lt;i class="fas fa-gas-pump"&gt;&lt;/i&gt; Gas Pump
                                                </option>
                                                <option value="fas fa-gavel" <?php if($info['icon'] == 'fas fa-gavel'){ echo 'selected'; } ?> data-select2-id="select2-data-546-puoe">
                                                    &lt;i class="fas fa-gavel"&gt;&lt;/i&gt; Gavel
                                                </option>
                                                <option value="fas fa-gem" <?php if($info['icon'] == 'fas fa-gem'){ echo 'selected'; } ?> data-select2-id="select2-data-547-aoen">
                                                    &lt;i class="fas fa-gem"&gt;&lt;/i&gt; Gem
                                                </option>
                                                <option value="fas fa-genderless" <?php if($info['icon'] == 'fas fa-genderless'){ echo 'selected'; } ?> data-select2-id="select2-data-548-4a8y">
                                                    &lt;i class="fas fa-genderless"&gt;&lt;/i&gt; Genderless
                                                </option>
                                                <option value="fab fa-get-pocket" <?php if($info['icon'] == 'fab fa-get-pocket'){ echo 'selected'; } ?> data-select2-id="select2-data-549-9rsn">
                                                    &lt;i class="fab fa-get-pocket"&gt;&lt;/i&gt; Get Pocket
                                                </option>
                                                <option value="fab fa-gg" <?php if($info['icon'] == 'fab fa-gg'){ echo 'selected'; } ?> data-select2-id="select2-data-550-koka">
                                                    &lt;i class="fab fa-gg"&gt;&lt;/i&gt; GG Currency
                                                </option>
                                                <option value="fab fa-gg-circle" <?php if($info['icon'] == 'fab fa-gg-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-551-pjj5">
                                                    &lt;i class="fab fa-gg-circle"&gt;&lt;/i&gt; GG Currency Circle
                                                </option>
                                                <option value="fas fa-gift" <?php if($info['icon'] == 'fas fa-gift'){ echo 'selected'; } ?> data-select2-id="select2-data-553-xlwa">
                                                    &lt;i class="fas fa-gift"&gt;&lt;/i&gt; gift
                                                </option>
                                                <option value="fab fa-git" <?php if($info['icon'] == 'fab fa-git'){ echo 'selected'; } ?> data-select2-id="select2-data-555-ndyq">
                                                    &lt;i class="fab fa-git"&gt;&lt;/i&gt; Git
                                                </option>
                                                <option value="fab fa-git-square" <?php if($info['icon'] == 'fab fa-git-square'){ echo 'selected'; } ?> data-select2-id="select2-data-557-6hgl">
                                                    &lt;i class="fab fa-git-square"&gt;&lt;/i&gt; Git Square
                                                </option>
                                                <option value="fab fa-github" <?php if($info['icon'] == 'fab fa-github'){ echo 'selected'; } ?> data-select2-id="select2-data-558-msrz">
                                                    &lt;i class="fab fa-github"&gt;&lt;/i&gt; GitHub
                                                </option>
                                                <option value="fab fa-github-alt" <?php if($info['icon'] == 'fab fa-github-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-559-q4sy">
                                                    &lt;i class="fab fa-github-alt"&gt;&lt;/i&gt; Alternate GitHub
                                                </option>
                                                <option value="fab fa-github-square" <?php if($info['icon'] == 'fab fa-github-square'){ echo 'selected'; } ?> data-select2-id="select2-data-560-oyqb">
                                                    &lt;i class="fab fa-github-square"&gt;&lt;/i&gt; GitHub Square
                                                </option>
                                                <option value="fab fa-gitkraken" <?php if($info['icon'] == 'fab fa-gitkraken'){ echo 'selected'; } ?> data-select2-id="select2-data-561-pgcy">
                                                    &lt;i class="fab fa-gitkraken"&gt;&lt;/i&gt; GitKraken
                                                </option>
                                                <option value="fab fa-gitlab" <?php if($info['icon'] == 'fab fa-gitlab'){ echo 'selected'; } ?> data-select2-id="select2-data-562-ue8k">
                                                    &lt;i class="fab fa-gitlab"&gt;&lt;/i&gt; GitLab
                                                </option>
                                                <option value="fab fa-gitter" <?php if($info['icon'] == 'fab fa-gitter'){ echo 'selected'; } ?> data-select2-id="select2-data-563-63ae">
                                                    &lt;i class="fab fa-gitter"&gt;&lt;/i&gt; Gitter
                                                </option>
                                                <option value="fas fa-glass-martini" <?php if($info['icon'] == 'fas fa-glass-martini'){ echo 'selected'; } ?> data-select2-id="select2-data-565-y83u">
                                                    &lt;i class="fas fa-glass-martini"&gt;&lt;/i&gt; Martini Glass
                                                </option>
                                                <option value="fas fa-glasses" <?php if($info['icon'] == 'fas fa-glasses'){ echo 'selected'; } ?> data-select2-id="select2-data-568-j7q6">
                                                    &lt;i class="fas fa-glasses"&gt;&lt;/i&gt; Glasses
                                                </option>
                                                <option value="fab fa-glide" <?php if($info['icon'] == 'fab fa-glide'){ echo 'selected'; } ?> data-select2-id="select2-data-569-twsg">
                                                    &lt;i class="fab fa-glide"&gt;&lt;/i&gt; Glide
                                                </option>
                                                <option value="fab fa-glide-g" <?php if($info['icon'] == 'fab fa-glide-g'){ echo 'selected'; } ?> data-select2-id="select2-data-570-v5pk">
                                                    &lt;i class="fab fa-glide-g"&gt;&lt;/i&gt; Glide G
                                                </option>
                                                <option value="fas fa-globe" <?php if($info['icon'] == 'fas fa-globe'){ echo 'selected'; } ?> data-select2-id="select2-data-571-jy2i">
                                                    &lt;i class="fas fa-globe"&gt;&lt;/i&gt; Globe
                                                </option>
                                                <option value="fab fa-gofore" <?php if($info['icon'] == 'fab fa-gofore'){ echo 'selected'; } ?> data-select2-id="select2-data-576-uc72">
                                                    &lt;i class="fab fa-gofore"&gt;&lt;/i&gt; Gofore
                                                </option>
                                                <option value="fas fa-golf-ball" <?php if($info['icon'] == 'fas fa-golf-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-577-g5uz">
                                                    &lt;i class="fas fa-golf-ball"&gt;&lt;/i&gt; Golf Ball
                                                </option>
                                                <option value="fab fa-goodreads" <?php if($info['icon'] == 'fab fa-goodreads'){ echo 'selected'; } ?> data-select2-id="select2-data-578-um58">
                                                    &lt;i class="fab fa-goodreads"&gt;&lt;/i&gt; Goodreads
                                                </option>
                                                <option value="fab fa-goodreads-g" <?php if($info['icon'] == 'fab fa-goodreads-g'){ echo 'selected'; } ?> data-select2-id="select2-data-579-3uvy">
                                                    &lt;i class="fab fa-goodreads-g"&gt;&lt;/i&gt; Goodreads G
                                                </option>
                                                <option value="fab fa-google" <?php if($info['icon'] == 'fab fa-google'){ echo 'selected'; } ?> data-select2-id="select2-data-580-8lam">
                                                    &lt;i class="fab fa-google"&gt;&lt;/i&gt; Google Logo
                                                </option>
                                                <option value="fab fa-google-drive" <?php if($info['icon'] == 'fab fa-google-drive'){ echo 'selected'; } ?> data-select2-id="select2-data-581-2q9l">
                                                    &lt;i class="fab fa-google-drive"&gt;&lt;/i&gt; Google Drive
                                                </option>
                                                <option value="fab fa-google-play" <?php if($info['icon'] == 'fab fa-google-play'){ echo 'selected'; } ?> data-select2-id="select2-data-583-ufgv">
                                                    &lt;i class="fab fa-google-play"&gt;&lt;/i&gt; Google Play
                                                </option>
                                                <option value="fab fa-google-plus" <?php if($info['icon'] == 'fab fa-google-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-584-sklm">
                                                    &lt;i class="fab fa-google-plus"&gt;&lt;/i&gt; Google Plus
                                                </option>
                                                <option value="fab fa-google-plus-g" <?php if($info['icon'] == 'fab fa-google-plus-g'){ echo 'selected'; } ?> data-select2-id="select2-data-585-4l3u">
                                                    &lt;i class="fab fa-google-plus-g"&gt;&lt;/i&gt; Google Plus G
                                                </option>
                                                <option value="fab fa-google-plus-square" <?php if($info['icon'] == 'fab fa-google-plus-square'){ echo 'selected'; } ?> data-select2-id="select2-data-586-9wgn">
                                                    &lt;i class="fab fa-google-plus-square"&gt;&lt;/i&gt; Google Plus Square
                                                </option>
                                                <option value="fab fa-google-wallet" <?php if($info['icon'] == 'fab fa-google-wallet'){ echo 'selected'; } ?> data-select2-id="select2-data-587-sd3w">
                                                    &lt;i class="fab fa-google-wallet"&gt;&lt;/i&gt; Google Wallet
                                                </option>
                                                <option value="fas fa-graduation-cap" <?php if($info['icon'] == 'fas fa-graduation-cap'){ echo 'selected'; } ?> data-select2-id="select2-data-589-wyua">
                                                    &lt;i class="fas fa-graduation-cap"&gt;&lt;/i&gt; Graduation Cap
                                                </option>
                                                <option value="fab fa-gratipay" <?php if($info['icon'] == 'fab fa-gratipay'){ echo 'selected'; } ?> data-select2-id="select2-data-590-xp8q">
                                                    &lt;i class="fab fa-gratipay"&gt;&lt;/i&gt; Gratipay (Gittip)
                                                </option>
                                                <option value="fab fa-grav" <?php if($info['icon'] == 'fab fa-grav'){ echo 'selected'; } ?> data-select2-id="select2-data-591-dkcr">
                                                    &lt;i class="fab fa-grav"&gt;&lt;/i&gt; Grav
                                                </option>
                                                <option value="fas fa-greater-than" <?php if($info['icon'] == 'fas fa-greater-than'){ echo 'selected'; } ?> data-select2-id="select2-data-592-3u0p">
                                                    &lt;i class="fas fa-greater-than"&gt;&lt;/i&gt; Greater Than
                                                </option>
                                                <option value="fas fa-greater-than-equal" <?php if($info['icon'] == 'fas fa-greater-than-equal'){ echo 'selected'; } ?> data-select2-id="select2-data-593-opm6">
                                                    &lt;i class="fas fa-greater-than-equal"&gt;&lt;/i&gt; Greater Than Equal To
                                                </option>
                                                <option value="fab fa-gripfire" <?php if($info['icon'] == 'fab fa-gripfire'){ echo 'selected'; } ?> data-select2-id="select2-data-612-kfik">
                                                    &lt;i class="fab fa-gripfire"&gt;&lt;/i&gt; Gripfire, Inc.
                                                </option>
                                                <option value="fab fa-grunt" <?php if($info['icon'] == 'fab fa-grunt'){ echo 'selected'; } ?> data-select2-id="select2-data-613-h8p4">
                                                    &lt;i class="fab fa-grunt"&gt;&lt;/i&gt; Grunt
                                                </option>
                                                <option value="fab fa-gulp" <?php if($info['icon'] == 'fab fa-gulp'){ echo 'selected'; } ?> data-select2-id="select2-data-616-99pf">
                                                    &lt;i class="fab fa-gulp"&gt;&lt;/i&gt; Gulp
                                                </option>
                                                <option value="fas fa-h-square" <?php if($info['icon'] == 'fas fa-h-square'){ echo 'selected'; } ?> data-select2-id="select2-data-617-eq7j">
                                                    &lt;i class="fas fa-h-square"&gt;&lt;/i&gt; H Square
                                                </option>
                                                <option value="fab fa-hacker-news" <?php if($info['icon'] == 'fab fa-hacker-news'){ echo 'selected'; } ?> data-select2-id="select2-data-618-axjd">
                                                    &lt;i class="fab fa-hacker-news"&gt;&lt;/i&gt; Hacker News
                                                </option>
                                                <option value="fab fa-hacker-news-square" <?php if($info['icon'] == 'fab fa-hacker-news-square'){ echo 'selected'; } ?> data-select2-id="select2-data-619-fy30">
                                                    &lt;i class="fab fa-hacker-news-square"&gt;&lt;/i&gt; Hacker News Square
                                                </option>
                                                <option value="fas fa-hand-holding" <?php if($info['icon'] == 'fas fa-hand-holding'){ echo 'selected'; } ?> data-select2-id="select2-data-624-1k55">
                                                    &lt;i class="fas fa-hand-holding"&gt;&lt;/i&gt; Hand Holding
                                                </option>
                                                <option value="fas fa-hand-holding-heart" <?php if($info['icon'] == 'fas fa-hand-holding-heart'){ echo 'selected'; } ?> data-select2-id="select2-data-625-snmt">
                                                    &lt;i class="fas fa-hand-holding-heart"&gt;&lt;/i&gt; Hand Holding Heart
                                                </option>
                                                <option value="fas fa-hand-holding-usd" <?php if($info['icon'] == 'fas fa-hand-holding-usd'){ echo 'selected'; } ?> data-select2-id="select2-data-627-awz3">
                                                    &lt;i class="fas fa-hand-holding-usd"&gt;&lt;/i&gt; Hand Holding US Dollar
                                                </option>
                                                <option value="fas fa-hand-lizard" <?php if($info['icon'] == 'fas fa-hand-lizard'){ echo 'selected'; } ?> data-select2-id="select2-data-629-n3ay">
                                                    &lt;i class="fas fa-hand-lizard"&gt;&lt;/i&gt; Lizard (Hand)
                                                </option>
                                                <option value="fas fa-hand-paper" <?php if($info['icon'] == 'fas fa-hand-paper'){ echo 'selected'; } ?> data-select2-id="select2-data-631-w9pa">
                                                    &lt;i class="fas fa-hand-paper"&gt;&lt;/i&gt; Paper (Hand)
                                                </option>
                                                <option value="fas fa-hand-peace" <?php if($info['icon'] == 'fas fa-hand-peace'){ echo 'selected'; } ?> data-select2-id="select2-data-632-pn86">
                                                    &lt;i class="fas fa-hand-peace"&gt;&lt;/i&gt; Peace (Hand)
                                                </option>
                                                <option value="fas fa-hand-point-down" <?php if($info['icon'] == 'fas fa-hand-point-down'){ echo 'selected'; } ?> data-select2-id="select2-data-633-lwop">
                                                    &lt;i class="fas fa-hand-point-down"&gt;&lt;/i&gt; Hand Pointing Down
                                                </option>
                                                <option value="fas fa-hand-point-left" <?php if($info['icon'] == 'fas fa-hand-point-left'){ echo 'selected'; } ?> data-select2-id="select2-data-634-bqn5">
                                                    &lt;i class="fas fa-hand-point-left"&gt;&lt;/i&gt; Hand Pointing Left
                                                </option>
                                                <option value="fas fa-hand-point-right" <?php if($info['icon'] == 'fas fa-hand-point-right'){ echo 'selected'; } ?> data-select2-id="select2-data-635-dv5k">
                                                    &lt;i class="fas fa-hand-point-right"&gt;&lt;/i&gt; Hand Pointing Right
                                                </option>
                                                <option value="fas fa-hand-point-up" <?php if($info['icon'] == 'fas fa-hand-point-up'){ echo 'selected'; } ?> data-select2-id="select2-data-636-x973">
                                                    &lt;i class="fas fa-hand-point-up"&gt;&lt;/i&gt; Hand Pointing Up
                                                </option>
                                                <option value="fas fa-hand-pointer" <?php if($info['icon'] == 'fas fa-hand-pointer'){ echo 'selected'; } ?> data-select2-id="select2-data-637-3grc">
                                                    &lt;i class="fas fa-hand-pointer"&gt;&lt;/i&gt; Pointer (Hand)
                                                </option>
                                                <option value="fas fa-hand-rock" <?php if($info['icon'] == 'fas fa-hand-rock'){ echo 'selected'; } ?> data-select2-id="select2-data-638-0x7b">
                                                    &lt;i class="fas fa-hand-rock"&gt;&lt;/i&gt; Rock (Hand)
                                                </option>
                                                <option value="fas fa-hand-scissors" <?php if($info['icon'] == 'fas fa-hand-scissors'){ echo 'selected'; } ?> data-select2-id="select2-data-639-5uuw">
                                                    &lt;i class="fas fa-hand-scissors"&gt;&lt;/i&gt; Scissors (Hand)
                                                </option>
                                                <option value="fas fa-hand-spock" <?php if($info['icon'] == 'fas fa-hand-spock'){ echo 'selected'; } ?> data-select2-id="select2-data-641-7xbb">
                                                    &lt;i class="fas fa-hand-spock"&gt;&lt;/i&gt; Spock (Hand)
                                                </option>
                                                <option value="fas fa-hands" <?php if($info['icon'] == 'fas fa-hands'){ echo 'selected'; } ?> data-select2-id="select2-data-642-w18a">
                                                    &lt;i class="fas fa-hands"&gt;&lt;/i&gt; Hands
                                                </option>
                                                <option value="fas fa-hands-helping" <?php if($info['icon'] == 'fas fa-hands-helping'){ echo 'selected'; } ?> data-select2-id="select2-data-643-my7k">
                                                    &lt;i class="fas fa-hands-helping"&gt;&lt;/i&gt; Helping Hands
                                                </option>
                                                <option value="fas fa-hashtag" <?php if($info['icon'] == 'fas fa-hashtag'){ echo 'selected'; } ?> data-select2-id="select2-data-650-w56f">
                                                    &lt;i class="fas fa-hashtag"&gt;&lt;/i&gt; Hashtag
                                                </option>
                                                <option value="fas fa-hat-cowboy" <?php if($info['icon'] == 'fas fa-hat-cowboy'){ echo 'selected'; } ?> data-select2-id="select2-data-651-97su">
                                                    &lt;i class="fas fa-hat-cowboy"&gt;&lt;/i&gt; Cowboy Hat
                                                </option>
                                                <option value="fas fa-hdd" <?php if($info['icon'] == 'fas fa-hdd'){ echo 'selected'; } ?> data-select2-id="select2-data-654-fdp2">
                                                    &lt;i class="fas fa-hdd"&gt;&lt;/i&gt; HDD
                                                </option>
                                                <option value="fas fa-heading" <?php if($info['icon'] == 'fas fa-heading'){ echo 'selected'; } ?> data-select2-id="select2-data-659-zv1q">
                                                    &lt;i class="fas fa-heading"&gt;&lt;/i&gt; heading
                                                </option>
                                                <option value="fas fa-headphones" <?php if($info['icon'] == 'fas fa-headphones'){ echo 'selected'; } ?> data-select2-id="select2-data-660-7gng">
                                                    &lt;i class="fas fa-headphones"&gt;&lt;/i&gt; headphones
                                                </option>
                                                <option value="fas fa-heart" <?php if($info['icon'] == 'fas fa-heart'){ echo 'selected'; } ?> data-select2-id="select2-data-663-k5mj">
                                                    &lt;i class="fas fa-heart"&gt;&lt;/i&gt; Heart
                                                </option>
                                                <option value="fas fa-heartbeat" <?php if($info['icon'] == 'fas fa-heartbeat'){ echo 'selected'; } ?> data-select2-id="select2-data-665-papv">
                                                    &lt;i class="fas fa-heartbeat"&gt;&lt;/i&gt; Heartbeat
                                                </option>
                                                <option value="fas fa-helicopter" <?php if($info['icon'] == 'fas fa-helicopter'){ echo 'selected'; } ?> data-select2-id="select2-data-666-xcov">
                                                    &lt;i class="fas fa-helicopter"&gt;&lt;/i&gt; Helicopter
                                                </option>
                                                <option value="fab fa-hips" <?php if($info['icon'] == 'fab fa-hips'){ echo 'selected'; } ?> data-select2-id="select2-data-670-i5y9">
                                                    &lt;i class="fab fa-hips"&gt;&lt;/i&gt; Hips
                                                </option>
                                                <option value="fab fa-hire-a-helper" <?php if($info['icon'] == 'fab fa-hire-a-helper'){ echo 'selected'; } ?> data-select2-id="select2-data-671-ykrw">
                                                    &lt;i class="fab fa-hire-a-helper"&gt;&lt;/i&gt; HireAHelper
                                                </option>
                                                <option value="fas fa-history" <?php if($info['icon'] == 'fas fa-history'){ echo 'selected'; } ?> data-select2-id="select2-data-672-yvvf">
                                                    &lt;i class="fas fa-history"&gt;&lt;/i&gt; History
                                                </option>
                                                <option value="fas fa-hockey-puck" <?php if($info['icon'] == 'fas fa-hockey-puck'){ echo 'selected'; } ?> data-select2-id="select2-data-674-8irq">
                                                    &lt;i class="fas fa-hockey-puck"&gt;&lt;/i&gt; Hockey Puck
                                                </option>
                                                <option value="fas fa-home" <?php if($info['icon'] == 'fas fa-home'){ echo 'selected'; } ?> data-select2-id="select2-data-676-2oqt">
                                                    &lt;i class="fas fa-home"&gt;&lt;/i&gt; home
                                                </option>
                                                <option value="fab fa-hooli" <?php if($info['icon'] == 'fab fa-hooli'){ echo 'selected'; } ?> data-select2-id="select2-data-677-2yyt">
                                                    &lt;i class="fab fa-hooli"&gt;&lt;/i&gt; Hooli
                                                </option>
                                                <option value="fas fa-hospital" <?php if($info['icon'] == 'fas fa-hospital'){ echo 'selected'; } ?> data-select2-id="select2-data-681-6wi9">
                                                    &lt;i class="fas fa-hospital"&gt;&lt;/i&gt; hospital
                                                </option>
                                                <option value="fas fa-hospital-alt" <?php if($info['icon'] == 'fas fa-hospital-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-682-xb50">
                                                    &lt;i class="fas fa-hospital-alt"&gt;&lt;/i&gt; Alternate Hospital
                                                </option>
                                                <option value="fas fa-hospital-symbol" <?php if($info['icon'] == 'fas fa-hospital-symbol'){ echo 'selected'; } ?> data-select2-id="select2-data-683-k6kq">
                                                    &lt;i class="fas fa-hospital-symbol"&gt;&lt;/i&gt; Hospital Symbol
                                                </option>
                                                <option value="fas fa-hotel" <?php if($info['icon'] == 'fas fa-hotel'){ echo 'selected'; } ?> data-select2-id="select2-data-687-b6hw">
                                                    &lt;i class="fas fa-hotel"&gt;&lt;/i&gt; Hotel
                                                </option>
                                                <option value="fab fa-hotjar" <?php if($info['icon'] == 'fab fa-hotjar'){ echo 'selected'; } ?> data-select2-id="select2-data-688-vtpa">
                                                    &lt;i class="fab fa-hotjar"&gt;&lt;/i&gt; Hotjar
                                                </option>
                                                <option value="fas fa-hourglass" <?php if($info['icon'] == 'fas fa-hourglass'){ echo 'selected'; } ?> data-select2-id="select2-data-689-z6t3">
                                                    &lt;i class="fas fa-hourglass"&gt;&lt;/i&gt; Hourglass
                                                </option>
                                                <option value="fas fa-hourglass-end" <?php if($info['icon'] == 'fas fa-hourglass-end'){ echo 'selected'; } ?> data-select2-id="select2-data-690-sdfc">
                                                    &lt;i class="fas fa-hourglass-end"&gt;&lt;/i&gt; Hourglass End
                                                </option>
                                                <option value="fas fa-hourglass-half" <?php if($info['icon'] == 'fas fa-hourglass-half'){ echo 'selected'; } ?> data-select2-id="select2-data-691-2g7j">
                                                    &lt;i class="fas fa-hourglass-half"&gt;&lt;/i&gt; Hourglass Half
                                                </option>
                                                <option value="fas fa-hourglass-start" <?php if($info['icon'] == 'fas fa-hourglass-start'){ echo 'selected'; } ?> data-select2-id="select2-data-692-ptcn">
                                                    &lt;i class="fas fa-hourglass-start"&gt;&lt;/i&gt; Hourglass Start
                                                </option>
                                                <option value="fab fa-houzz" <?php if($info['icon'] == 'fab fa-houzz'){ echo 'selected'; } ?> data-select2-id="select2-data-695-9vd1">
                                                    &lt;i class="fab fa-houzz"&gt;&lt;/i&gt; Houzz
                                                </option>
                                                <option value="fab fa-html5" <?php if($info['icon'] == 'fab fa-html5'){ echo 'selected'; } ?> data-select2-id="select2-data-697-eqfa">
                                                    &lt;i class="fab fa-html5"&gt;&lt;/i&gt; HTML 5 Logo
                                                </option>
                                                <option value="fab fa-hubspot" <?php if($info['icon'] == 'fab fa-hubspot'){ echo 'selected'; } ?> data-select2-id="select2-data-698-dhxo">
                                                    &lt;i class="fab fa-hubspot"&gt;&lt;/i&gt; HubSpot
                                                </option>
                                                <option value="fas fa-i-cursor" <?php if($info['icon'] == 'fas fa-i-cursor'){ echo 'selected'; } ?> data-select2-id="select2-data-699-spma">
                                                    &lt;i class="fas fa-i-cursor"&gt;&lt;/i&gt; I Beam Cursor
                                                </option>
                                                <option value="fas fa-id-badge" <?php if($info['icon'] == 'fas fa-id-badge'){ echo 'selected'; } ?> data-select2-id="select2-data-703-w2oq">
                                                    &lt;i class="fas fa-id-badge"&gt;&lt;/i&gt; Identification Badge
                                                </option>
                                                <option value="fas fa-id-card" <?php if($info['icon'] == 'fas fa-id-card'){ echo 'selected'; } ?> data-select2-id="select2-data-704-naz2">
                                                    &lt;i class="fas fa-id-card"&gt;&lt;/i&gt; Identification Card
                                                </option>
                                                <option value="fas fa-id-card-alt" <?php if($info['icon'] == 'fas fa-id-card-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-705-2ted">
                                                    &lt;i class="fas fa-id-card-alt"&gt;&lt;/i&gt; Alternate Identification Card
                                                </option>
                                                <option value="fas fa-image" <?php if($info['icon'] == 'fas fa-image'){ echo 'selected'; } ?> data-select2-id="select2-data-708-junf">
                                                    &lt;i class="fas fa-image"&gt;&lt;/i&gt; Image
                                                </option>
                                                <option value="fas fa-images" <?php if($info['icon'] == 'fas fa-images'){ echo 'selected'; } ?> data-select2-id="select2-data-709-ndnm">
                                                    &lt;i class="fas fa-images"&gt;&lt;/i&gt; Images
                                                </option>
                                                <option value="fab fa-imdb" <?php if($info['icon'] == 'fab fa-imdb'){ echo 'selected'; } ?> data-select2-id="select2-data-710-8mz6">
                                                    &lt;i class="fab fa-imdb"&gt;&lt;/i&gt; IMDB
                                                </option>
                                                <option value="fas fa-inbox" <?php if($info['icon'] == 'fas fa-inbox'){ echo 'selected'; } ?> data-select2-id="select2-data-711-lsnt">
                                                    &lt;i class="fas fa-inbox"&gt;&lt;/i&gt; inbox
                                                </option>
                                                <option value="fas fa-indent" <?php if($info['icon'] == 'fas fa-indent'){ echo 'selected'; } ?> data-select2-id="select2-data-712-nbep">
                                                    &lt;i class="fas fa-indent"&gt;&lt;/i&gt; Indent
                                                </option>
                                                <option value="fas fa-industry" <?php if($info['icon'] == 'fas fa-industry'){ echo 'selected'; } ?> data-select2-id="select2-data-713-mwvz">
                                                    &lt;i class="fas fa-industry"&gt;&lt;/i&gt; Industry
                                                </option>
                                                <option value="fas fa-infinity" <?php if($info['icon'] == 'fas fa-infinity'){ echo 'selected'; } ?> data-select2-id="select2-data-714-dabi">
                                                    &lt;i class="fas fa-infinity"&gt;&lt;/i&gt; Infinity
                                                </option>
                                                <option value="fas fa-info" <?php if($info['icon'] == 'fas fa-info'){ echo 'selected'; } ?> data-select2-id="select2-data-715-z82p">
                                                    &lt;i class="fas fa-info"&gt;&lt;/i&gt; Info
                                                </option>
                                                <option value="fas fa-info-circle" <?php if($info['icon'] == 'fas fa-info-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-716-ibti">
                                                    &lt;i class="fas fa-info-circle"&gt;&lt;/i&gt; Info Circle
                                                </option>
                                                <option value="fab fa-instagram" <?php if($info['icon'] == 'fab fa-instagram'){ echo 'selected'; } ?> data-select2-id="select2-data-718-nih5">
                                                    &lt;i class="fab fa-instagram"&gt;&lt;/i&gt; Instagram
                                                </option>
                                                <option value="fab fa-internet-explorer" <?php if($info['icon'] == 'fab fa-internet-explorer'){ echo 'selected'; } ?> data-select2-id="select2-data-722-q570">
                                                    &lt;i class="fab fa-internet-explorer"&gt;&lt;/i&gt; Internet-explorer
                                                </option>
                                                <option value="fab fa-ioxhost" <?php if($info['icon'] == 'fab fa-ioxhost'){ echo 'selected'; } ?> data-select2-id="select2-data-724-1vww">
                                                    &lt;i class="fab fa-ioxhost"&gt;&lt;/i&gt; ioxhost
                                                </option>
                                                <option value="fas fa-italic" <?php if($info['icon'] == 'fas fa-italic'){ echo 'selected'; } ?> data-select2-id="select2-data-725-836k">
                                                    &lt;i class="fas fa-italic"&gt;&lt;/i&gt; italic
                                                </option>
                                                <option value="fab fa-itunes" <?php if($info['icon'] == 'fab fa-itunes'){ echo 'selected'; } ?> data-select2-id="select2-data-727-pcdt">
                                                    &lt;i class="fab fa-itunes"&gt;&lt;/i&gt; iTunes
                                                </option>
                                                <option value="fab fa-itunes-note" <?php if($info['icon'] == 'fab fa-itunes-note'){ echo 'selected'; } ?> data-select2-id="select2-data-728-pcd2">
                                                    &lt;i class="fab fa-itunes-note"&gt;&lt;/i&gt; Itunes Note
                                                </option>
                                                <option value="fab fa-java" <?php if($info['icon'] == 'fab fa-java'){ echo 'selected'; } ?> data-select2-id="select2-data-729-gipw">
                                                    &lt;i class="fab fa-java"&gt;&lt;/i&gt; Java
                                                </option>
                                                <option value="fab fa-jedi-order" <?php if($info['icon'] == 'fab fa-jedi-order'){ echo 'selected'; } ?> data-select2-id="select2-data-731-fyim">
                                                    &lt;i class="fab fa-jedi-order"&gt;&lt;/i&gt; Jedi Order
                                                </option>
                                                <option value="fab fa-jenkins" <?php if($info['icon'] == 'fab fa-jenkins'){ echo 'selected'; } ?> data-select2-id="select2-data-732-ejuz">
                                                    &lt;i class="fab fa-jenkins"&gt;&lt;/i&gt; Jenkis
                                                </option>
                                                <option value="fab fa-joget" <?php if($info['icon'] == 'fab fa-joget'){ echo 'selected'; } ?> data-select2-id="select2-data-734-ek48">
                                                    &lt;i class="fab fa-joget"&gt;&lt;/i&gt; Joget
                                                </option>
                                                <option value="fab fa-joomla" <?php if($info['icon'] == 'fab fa-joomla'){ echo 'selected'; } ?> data-select2-id="select2-data-736-mmfz">
                                                    &lt;i class="fab fa-joomla"&gt;&lt;/i&gt; Joomla Logo
                                                </option>
                                                <option value="fab fa-js" <?php if($info['icon'] == 'fab fa-js'){ echo 'selected'; } ?> data-select2-id="select2-data-738-55sc">
                                                    &lt;i class="fab fa-js"&gt;&lt;/i&gt; JavaScript (JS)
                                                </option>
                                                <option value="fab fa-js-square" <?php if($info['icon'] == 'fab fa-js-square'){ echo 'selected'; } ?> data-select2-id="select2-data-739-chi3">
                                                    &lt;i class="fab fa-js-square"&gt;&lt;/i&gt; JavaScript (JS) Square
                                                </option>
                                                <option value="fab fa-jsfiddle" <?php if($info['icon'] == 'fab fa-jsfiddle'){ echo 'selected'; } ?> data-select2-id="select2-data-740-tc60">
                                                    &lt;i class="fab fa-jsfiddle"&gt;&lt;/i&gt; jsFiddle
                                                </option>
                                                <option value="fas fa-key" <?php if($info['icon'] == 'fas fa-key'){ echo 'selected'; } ?> data-select2-id="select2-data-743-vag0">
                                                    &lt;i class="fas fa-key"&gt;&lt;/i&gt; key
                                                </option>
                                                <option value="fab fa-keybase" <?php if($info['icon'] == 'fab fa-keybase'){ echo 'selected'; } ?> data-select2-id="select2-data-744-5phl">
                                                    &lt;i class="fab fa-keybase"&gt;&lt;/i&gt; Keybase
                                                </option>
                                                <option value="fas fa-keyboard" <?php if($info['icon'] == 'fas fa-keyboard'){ echo 'selected'; } ?> data-select2-id="select2-data-745-iev6">
                                                    &lt;i class="fas fa-keyboard"&gt;&lt;/i&gt; Keyboard
                                                </option>
                                                <option value="fab fa-keycdn" <?php if($info['icon'] == 'fab fa-keycdn'){ echo 'selected'; } ?> data-select2-id="select2-data-746-xmwc">
                                                    &lt;i class="fab fa-keycdn"&gt;&lt;/i&gt; KeyCDN
                                                </option>
                                                <option value="fab fa-kickstarter" <?php if($info['icon'] == 'fab fa-kickstarter'){ echo 'selected'; } ?> data-select2-id="select2-data-748-qzac">
                                                    &lt;i class="fab fa-kickstarter"&gt;&lt;/i&gt; Kickstarter
                                                </option>
                                                <option value="fab fa-kickstarter-k" <?php if($info['icon'] == 'fab fa-kickstarter-k'){ echo 'selected'; } ?> data-select2-id="select2-data-749-07rc">
                                                    &lt;i class="fab fa-kickstarter-k"&gt;&lt;/i&gt; Kickstarter K
                                                </option>
                                                <option value="fas fa-kiwi-bird" <?php if($info['icon'] == 'fas fa-kiwi-bird'){ echo 'selected'; } ?> data-select2-id="select2-data-753-r536">
                                                    &lt;i class="fas fa-kiwi-bird"&gt;&lt;/i&gt; Kiwi Bird
                                                </option>
                                                <option value="fab fa-korvue" <?php if($info['icon'] == 'fab fa-korvue'){ echo 'selected'; } ?> data-select2-id="select2-data-754-4npx">
                                                    &lt;i class="fab fa-korvue"&gt;&lt;/i&gt; KORVUE
                                                </option>
                                                <option value="fas fa-language" <?php if($info['icon'] == 'fas fa-language'){ echo 'selected'; } ?> data-select2-id="select2-data-756-awit">
                                                    &lt;i class="fas fa-language"&gt;&lt;/i&gt; Language
                                                </option>
                                                <option value="fas fa-laptop" <?php if($info['icon'] == 'fas fa-laptop'){ echo 'selected'; } ?> data-select2-id="select2-data-757-u94b">
                                                    &lt;i class="fas fa-laptop"&gt;&lt;/i&gt; Laptop
                                                </option>
                                                <option value="fab fa-laravel" <?php if($info['icon'] == 'fab fa-laravel'){ echo 'selected'; } ?> data-select2-id="select2-data-761-fjx3">
                                                    &lt;i class="fab fa-laravel"&gt;&lt;/i&gt; Laravel
                                                </option>
                                                <option value="fab fa-lastfm" <?php if($info['icon'] == 'fab fa-lastfm'){ echo 'selected'; } ?> data-select2-id="select2-data-762-vwjo">
                                                    &lt;i class="fab fa-lastfm"&gt;&lt;/i&gt; last.fm
                                                </option>
                                                <option value="fab fa-lastfm-square" <?php if($info['icon'] == 'fab fa-lastfm-square'){ echo 'selected'; } ?> data-select2-id="select2-data-763-68wl">
                                                    &lt;i class="fab fa-lastfm-square"&gt;&lt;/i&gt; last.fm Square
                                                </option>
                                                <option value="fas fa-leaf" <?php if($info['icon'] == 'fas fa-leaf'){ echo 'selected'; } ?> data-select2-id="select2-data-769-24f4">
                                                    &lt;i class="fas fa-leaf"&gt;&lt;/i&gt; leaf
                                                </option>
                                                <option value="fab fa-leanpub" <?php if($info['icon'] == 'fab fa-leanpub'){ echo 'selected'; } ?> data-select2-id="select2-data-770-w1kr">
                                                    &lt;i class="fab fa-leanpub"&gt;&lt;/i&gt; Leanpub
                                                </option>
                                                <option value="fas fa-lemon" <?php if($info['icon'] == 'fas fa-lemon'){ echo 'selected'; } ?> data-select2-id="select2-data-771-jsjj">
                                                    &lt;i class="fas fa-lemon"&gt;&lt;/i&gt; Lemon
                                                </option>
                                                <option value="fab fa-less" <?php if($info['icon'] == 'fab fa-less'){ echo 'selected'; } ?> data-select2-id="select2-data-772-xkbh">
                                                    &lt;i class="fab fa-less"&gt;&lt;/i&gt; Less
                                                </option>
                                                <option value="fas fa-less-than" <?php if($info['icon'] == 'fas fa-less-than'){ echo 'selected'; } ?> data-select2-id="select2-data-773-dffv">
                                                    &lt;i class="fas fa-less-than"&gt;&lt;/i&gt; Less Than
                                                </option>
                                                <option value="fas fa-less-than-equal" <?php if($info['icon'] == 'fas fa-less-than-equal'){ echo 'selected'; } ?> data-select2-id="select2-data-774-nuiu">
                                                    &lt;i class="fas fa-less-than-equal"&gt;&lt;/i&gt; Less Than Equal To
                                                </option>
                                                <option value="fas fa-level-down-alt" <?php if($info['icon'] == 'fas fa-level-down-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-775-hjfn">
                                                    &lt;i class="fas fa-level-down-alt"&gt;&lt;/i&gt; Alternate Level Down
                                                </option>
                                                <option value="fas fa-level-up-alt" <?php if($info['icon'] == 'fas fa-level-up-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-776-rdfn">
                                                    &lt;i class="fas fa-level-up-alt"&gt;&lt;/i&gt; Alternate Level Up
                                                </option>
                                                <option value="fas fa-life-ring" <?php if($info['icon'] == 'fas fa-life-ring'){ echo 'selected'; } ?> data-select2-id="select2-data-777-ceat">
                                                    &lt;i class="fas fa-life-ring"&gt;&lt;/i&gt; Life Ring
                                                </option>
                                                <option value="fas fa-lightbulb" <?php if($info['icon'] == 'fas fa-lightbulb'){ echo 'selected'; } ?> data-select2-id="select2-data-778-2fes">
                                                    &lt;i class="fas fa-lightbulb"&gt;&lt;/i&gt; Lightbulb
                                                </option>
                                                <option value="fab fa-line" <?php if($info['icon'] == 'fab fa-line'){ echo 'selected'; } ?> data-select2-id="select2-data-779-ta68">
                                                    &lt;i class="fab fa-line"&gt;&lt;/i&gt; Line
                                                </option>
                                                <option value="fas fa-link" <?php if($info['icon'] == 'fas fa-link'){ echo 'selected'; } ?> data-select2-id="select2-data-780-phta">
                                                    &lt;i class="fas fa-link"&gt;&lt;/i&gt; Link
                                                </option>
                                                <option value="fab fa-linkedin" <?php if($info['icon'] == 'fab fa-linkedin'){ echo 'selected'; } ?> data-select2-id="select2-data-781-z4fv">
                                                    &lt;i class="fab fa-linkedin"&gt;&lt;/i&gt; LinkedIn
                                                </option>
                                                <option value="fab fa-linkedin-in" <?php if($info['icon'] == 'fab fa-linkedin-in'){ echo 'selected'; } ?> data-select2-id="select2-data-782-toht">
                                                    &lt;i class="fab fa-linkedin-in"&gt;&lt;/i&gt; LinkedIn In
                                                </option>
                                                <option value="fab fa-linode" <?php if($info['icon'] == 'fab fa-linode'){ echo 'selected'; } ?> data-select2-id="select2-data-783-qu8b">
                                                    &lt;i class="fab fa-linode"&gt;&lt;/i&gt; Linode
                                                </option>
                                                <option value="fab fa-linux" <?php if($info['icon'] == 'fab fa-linux'){ echo 'selected'; } ?> data-select2-id="select2-data-784-3up9">
                                                    &lt;i class="fab fa-linux"&gt;&lt;/i&gt; Linux
                                                </option>
                                                <option value="fas fa-lira-sign" <?php if($info['icon'] == 'fas fa-lira-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-785-akcr">
                                                    &lt;i class="fas fa-lira-sign"&gt;&lt;/i&gt; Turkish Lira Sign
                                                </option>
                                                <option value="fas fa-list" <?php if($info['icon'] == 'fas fa-list'){ echo 'selected'; } ?> data-select2-id="select2-data-786-ji0k">
                                                    &lt;i class="fas fa-list"&gt;&lt;/i&gt; List
                                                </option>
                                                <option value="fas fa-list-alt" <?php if($info['icon'] == 'fas fa-list-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-787-45z7">
                                                    &lt;i class="fas fa-list-alt"&gt;&lt;/i&gt; Alternate List
                                                </option>
                                                <option value="fas fa-list-ol" <?php if($info['icon'] == 'fas fa-list-ol'){ echo 'selected'; } ?> data-select2-id="select2-data-788-0boo">
                                                    &lt;i class="fas fa-list-ol"&gt;&lt;/i&gt; list-ol
                                                </option>
                                                <option value="fas fa-list-ul" <?php if($info['icon'] == 'fas fa-list-ul'){ echo 'selected'; } ?> data-select2-id="select2-data-789-23fp">
                                                    &lt;i class="fas fa-list-ul"&gt;&lt;/i&gt; list-ul
                                                </option>
                                                <option value="fas fa-location-arrow" <?php if($info['icon'] == 'fas fa-location-arrow'){ echo 'selected'; } ?> data-select2-id="select2-data-790-j6r4">
                                                    &lt;i class="fas fa-location-arrow"&gt;&lt;/i&gt; location-arrow
                                                </option>
                                                <option value="fas fa-lock" <?php if($info['icon'] == 'fas fa-lock'){ echo 'selected'; } ?> data-select2-id="select2-data-791-6czr">
                                                    &lt;i class="fas fa-lock"&gt;&lt;/i&gt; lock
                                                </option>
                                                <option value="fas fa-lock-open" <?php if($info['icon'] == 'fas fa-lock-open'){ echo 'selected'; } ?> data-select2-id="select2-data-792-0515">
                                                    &lt;i class="fas fa-lock-open"&gt;&lt;/i&gt; Lock Open
                                                </option>
                                                <option value="fas fa-long-arrow-alt-down" <?php if($info['icon'] == 'fas fa-long-arrow-alt-down'){ echo 'selected'; } ?> data-select2-id="select2-data-793-agbj">
                                                    &lt;i class="fas fa-long-arrow-alt-down"&gt;&lt;/i&gt; Alternate Long Arrow Down
                                                </option>
                                                <option value="fas fa-long-arrow-alt-left" <?php if($info['icon'] == 'fas fa-long-arrow-alt-left'){ echo 'selected'; } ?> data-select2-id="select2-data-794-liqt">
                                                    &lt;i class="fas fa-long-arrow-alt-left"&gt;&lt;/i&gt; Alternate Long Arrow Left
                                                </option>
                                                <option value="fas fa-long-arrow-alt-right" <?php if($info['icon'] == 'fas fa-long-arrow-alt-right'){ echo 'selected'; } ?> data-select2-id="select2-data-795-ev1u">
                                                    &lt;i class="fas fa-long-arrow-alt-right"&gt;&lt;/i&gt; Alternate Long Arrow Right
                                                </option>
                                                <option value="fas fa-long-arrow-alt-up" <?php if($info['icon'] == 'fas fa-long-arrow-alt-up'){ echo 'selected'; } ?> data-select2-id="select2-data-796-f2po">
                                                    &lt;i class="fas fa-long-arrow-alt-up"&gt;&lt;/i&gt; Alternate Long Arrow Up
                                                </option>
                                                <option value="fas fa-low-vision" <?php if($info['icon'] == 'fas fa-low-vision'){ echo 'selected'; } ?> data-select2-id="select2-data-797-7tkm">
                                                    &lt;i class="fas fa-low-vision"&gt;&lt;/i&gt; Low Vision
                                                </option>
                                                <option value="fab fa-lyft" <?php if($info['icon'] == 'fab fa-lyft'){ echo 'selected'; } ?> data-select2-id="select2-data-801-s00x">
                                                    &lt;i class="fab fa-lyft"&gt;&lt;/i&gt; lyft
                                                </option>
                                                <option value="fab fa-magento" <?php if($info['icon'] == 'fab fa-magento'){ echo 'selected'; } ?> data-select2-id="select2-data-802-35li">
                                                    &lt;i class="fab fa-magento"&gt;&lt;/i&gt; Magento
                                                </option>
                                                <option value="fas fa-magic" <?php if($info['icon'] == 'fas fa-magic'){ echo 'selected'; } ?> data-select2-id="select2-data-803-up3o">
                                                    &lt;i class="fas fa-magic"&gt;&lt;/i&gt; magic
                                                </option>
                                                <option value="fas fa-magnet" <?php if($info['icon'] == 'fas fa-magnet'){ echo 'selected'; } ?> data-select2-id="select2-data-804-l258">
                                                    &lt;i class="fas fa-magnet"&gt;&lt;/i&gt; magnet
                                                </option>
                                                <option value="fas fa-male" <?php if($info['icon'] == 'fas fa-male'){ echo 'selected'; } ?> data-select2-id="select2-data-807-5n9p">
                                                    &lt;i class="fas fa-male"&gt;&lt;/i&gt; Male
                                                </option>
                                                <option value="fab fa-mandalorian" <?php if($info['icon'] == 'fab fa-mandalorian'){ echo 'selected'; } ?> data-select2-id="select2-data-808-9smn">
                                                    &lt;i class="fab fa-mandalorian"&gt;&lt;/i&gt; Mandalorian
                                                </option>
                                                <option value="fas fa-map" <?php if($info['icon'] == 'fas fa-map'){ echo 'selected'; } ?> data-select2-id="select2-data-809-uew9">
                                                    &lt;i class="fas fa-map"&gt;&lt;/i&gt; Map
                                                </option>
                                                <option value="fas fa-map-marker" <?php if($info['icon'] == 'fas fa-map-marker'){ echo 'selected'; } ?> data-select2-id="select2-data-812-4ias">
                                                    &lt;i class="fas fa-map-marker"&gt;&lt;/i&gt; map-marker
                                                </option>
                                                <option value="fas fa-map-marker-alt" <?php if($info['icon'] == 'fas fa-map-marker-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-813-jt5r">
                                                    &lt;i class="fas fa-map-marker-alt"&gt;&lt;/i&gt; Alternate Map Marker
                                                </option>
                                                <option value="fas fa-map-pin" <?php if($info['icon'] == 'fas fa-map-pin'){ echo 'selected'; } ?> data-select2-id="select2-data-814-zltm">
                                                    &lt;i class="fas fa-map-pin"&gt;&lt;/i&gt; Map Pin
                                                </option>
                                                <option value="fas fa-map-signs" <?php if($info['icon'] == 'fas fa-map-signs'){ echo 'selected'; } ?> data-select2-id="select2-data-815-gvqd">
                                                    &lt;i class="fas fa-map-signs"&gt;&lt;/i&gt; Map Signs
                                                </option>
                                                <option value="fas fa-mars" <?php if($info['icon'] == 'fas fa-mars'){ echo 'selected'; } ?> data-select2-id="select2-data-818-jmpe">
                                                    &lt;i class="fas fa-mars"&gt;&lt;/i&gt; Mars
                                                </option>
                                                <option value="fas fa-mars-double" <?php if($info['icon'] == 'fas fa-mars-double'){ echo 'selected'; } ?> data-select2-id="select2-data-819-mehw">
                                                    &lt;i class="fas fa-mars-double"&gt;&lt;/i&gt; Mars Double
                                                </option>
                                                <option value="fas fa-mars-stroke" <?php if($info['icon'] == 'fas fa-mars-stroke'){ echo 'selected'; } ?> data-select2-id="select2-data-820-mutl">
                                                    &lt;i class="fas fa-mars-stroke"&gt;&lt;/i&gt; Mars Stroke
                                                </option>
                                                <option value="fas fa-mars-stroke-h" <?php if($info['icon'] == 'fas fa-mars-stroke-h'){ echo 'selected'; } ?> data-select2-id="select2-data-821-f6hd">
                                                    &lt;i class="fas fa-mars-stroke-h"&gt;&lt;/i&gt; Mars Stroke Horizontal
                                                </option>
                                                <option value="fas fa-mars-stroke-v" <?php if($info['icon'] == 'fas fa-mars-stroke-v'){ echo 'selected'; } ?> data-select2-id="select2-data-822-t6qo">
                                                    &lt;i class="fas fa-mars-stroke-v"&gt;&lt;/i&gt; Mars Stroke Vertical
                                                </option>
                                                <option value="fab fa-mastodon" <?php if($info['icon'] == 'fab fa-mastodon'){ echo 'selected'; } ?> data-select2-id="select2-data-824-1hiz">
                                                    &lt;i class="fab fa-mastodon"&gt;&lt;/i&gt; Mastodon
                                                </option>
                                                <option value="fab fa-maxcdn" <?php if($info['icon'] == 'fab fa-maxcdn'){ echo 'selected'; } ?> data-select2-id="select2-data-825-w652">
                                                    &lt;i class="fab fa-maxcdn"&gt;&lt;/i&gt; MaxCDN
                                                </option>
                                                <option value="fab fa-medapps" <?php if($info['icon'] == 'fab fa-medapps'){ echo 'selected'; } ?> data-select2-id="select2-data-828-ojpa">
                                                    &lt;i class="fab fa-medapps"&gt;&lt;/i&gt; MedApps
                                                </option>
                                                <option value="fab fa-medium" <?php if($info['icon'] == 'fab fa-medium'){ echo 'selected'; } ?> data-select2-id="select2-data-829-oz0e">
                                                    &lt;i class="fab fa-medium"&gt;&lt;/i&gt; Medium
                                                </option>
                                                <option value="fab fa-medium-m" <?php if($info['icon'] == 'fab fa-medium-m'){ echo 'selected'; } ?> data-select2-id="select2-data-830-0n1a">
                                                    &lt;i class="fab fa-medium-m"&gt;&lt;/i&gt; Medium M
                                                </option>
                                                <option value="fas fa-medkit" <?php if($info['icon'] == 'fas fa-medkit'){ echo 'selected'; } ?> data-select2-id="select2-data-831-xpdu">
                                                    &lt;i class="fas fa-medkit"&gt;&lt;/i&gt; medkit
                                                </option>
                                                <option value="fab fa-medrt" <?php if($info['icon'] == 'fab fa-medrt'){ echo 'selected'; } ?> data-select2-id="select2-data-832-e0g9">
                                                    &lt;i class="fab fa-medrt"&gt;&lt;/i&gt; MRT
                                                </option>
                                                <option value="fab fa-meetup" <?php if($info['icon'] == 'fab fa-meetup'){ echo 'selected'; } ?> data-select2-id="select2-data-833-nsm3">
                                                    &lt;i class="fab fa-meetup"&gt;&lt;/i&gt; Meetup
                                                </option>
                                                <option value="fas fa-meh" <?php if($info['icon'] == 'fas fa-meh'){ echo 'selected'; } ?> data-select2-id="select2-data-835-h5z8">
                                                    &lt;i class="fas fa-meh"&gt;&lt;/i&gt; Neutral Face
                                                </option>
                                                <option value="fas fa-memory" <?php if($info['icon'] == 'fas fa-memory'){ echo 'selected'; } ?> data-select2-id="select2-data-838-7iw7">
                                                    &lt;i class="fas fa-memory"&gt;&lt;/i&gt; Memory
                                                </option>
                                                <option value="fas fa-mercury" <?php if($info['icon'] == 'fas fa-mercury'){ echo 'selected'; } ?> data-select2-id="select2-data-841-ciax">
                                                    &lt;i class="fas fa-mercury"&gt;&lt;/i&gt; Mercury
                                                </option>
                                                <option value="fas fa-microchip" <?php if($info['icon'] == 'fas fa-microchip'){ echo 'selected'; } ?> data-select2-id="select2-data-844-jiak">
                                                    &lt;i class="fas fa-microchip"&gt;&lt;/i&gt; Microchip
                                                </option>
                                                <option value="fas fa-microphone" <?php if($info['icon'] == 'fas fa-microphone'){ echo 'selected'; } ?> data-select2-id="select2-data-845-czlj">
                                                    &lt;i class="fas fa-microphone"&gt;&lt;/i&gt; microphone
                                                </option>
                                                <option value="fas fa-microphone-alt" <?php if($info['icon'] == 'fas fa-microphone-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-846-80ba">
                                                    &lt;i class="fas fa-microphone-alt"&gt;&lt;/i&gt; Alternate Microphone
                                                </option>
                                                <option value="fas fa-microphone-alt-slash" <?php if($info['icon'] == 'fas fa-microphone-alt-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-847-mzxy">
                                                    &lt;i class="fas fa-microphone-alt-slash"&gt;&lt;/i&gt; Alternate Microphone Slash
                                                </option>
                                                <option value="fas fa-microphone-slash" <?php if($info['icon'] == 'fas fa-microphone-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-848-08ph">
                                                    &lt;i class="fas fa-microphone-slash"&gt;&lt;/i&gt; Microphone Slash
                                                </option>
                                                <option value="fab fa-microsoft" <?php if($info['icon'] == 'fab fa-microsoft'){ echo 'selected'; } ?> data-select2-id="select2-data-850-umoi">
                                                    &lt;i class="fab fa-microsoft"&gt;&lt;/i&gt; Microsoft
                                                </option>
                                                <option value="fas fa-minus" <?php if($info['icon'] == 'fas fa-minus'){ echo 'selected'; } ?> data-select2-id="select2-data-851-ei1s">
                                                    &lt;i class="fas fa-minus"&gt;&lt;/i&gt; minus
                                                </option>
                                                <option value="fas fa-minus-circle" <?php if($info['icon'] == 'fas fa-minus-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-852-ofbc">
                                                    &lt;i class="fas fa-minus-circle"&gt;&lt;/i&gt; Minus Circle
                                                </option>
                                                <option value="fas fa-minus-square" <?php if($info['icon'] == 'fas fa-minus-square'){ echo 'selected'; } ?> data-select2-id="select2-data-853-mrww">
                                                    &lt;i class="fas fa-minus-square"&gt;&lt;/i&gt; Minus Square
                                                </option>
                                                <option value="fab fa-mix" <?php if($info['icon'] == 'fab fa-mix'){ echo 'selected'; } ?> data-select2-id="select2-data-855-dm3z">
                                                    &lt;i class="fab fa-mix"&gt;&lt;/i&gt; Mix
                                                </option>
                                                <option value="fab fa-mixcloud" <?php if($info['icon'] == 'fab fa-mixcloud'){ echo 'selected'; } ?> data-select2-id="select2-data-856-0xot">
                                                    &lt;i class="fab fa-mixcloud"&gt;&lt;/i&gt; Mixcloud
                                                </option>
                                                <option value="fab fa-mizuni" <?php if($info['icon'] == 'fab fa-mizuni'){ echo 'selected'; } ?> data-select2-id="select2-data-858-vl25">
                                                    &lt;i class="fab fa-mizuni"&gt;&lt;/i&gt; Mizuni
                                                </option>
                                                <option value="fas fa-mobile" <?php if($info['icon'] == 'fas fa-mobile'){ echo 'selected'; } ?> data-select2-id="select2-data-859-5u0v">
                                                    &lt;i class="fas fa-mobile"&gt;&lt;/i&gt; Mobile Phone
                                                </option>
                                                <option value="fas fa-mobile-alt" <?php if($info['icon'] == 'fas fa-mobile-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-860-s2g8">
                                                    &lt;i class="fas fa-mobile-alt"&gt;&lt;/i&gt; Alternate Mobile
                                                </option>
                                                <option value="fab fa-modx" <?php if($info['icon'] == 'fab fa-modx'){ echo 'selected'; } ?> data-select2-id="select2-data-861-qakp">
                                                    &lt;i class="fab fa-modx"&gt;&lt;/i&gt; MODX
                                                </option>
                                                <option value="fab fa-monero" <?php if($info['icon'] == 'fab fa-monero'){ echo 'selected'; } ?> data-select2-id="select2-data-862-g6lg">
                                                    &lt;i class="fab fa-monero"&gt;&lt;/i&gt; Monero
                                                </option>
                                                <option value="fas fa-money-bill" <?php if($info['icon'] == 'fas fa-money-bill'){ echo 'selected'; } ?> data-select2-id="select2-data-863-wsmu">
                                                    &lt;i class="fas fa-money-bill"&gt;&lt;/i&gt; Money Bill
                                                </option>
                                                <option value="fas fa-money-bill-alt" <?php if($info['icon'] == 'fas fa-money-bill-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-864-juee">
                                                    &lt;i class="fas fa-money-bill-alt"&gt;&lt;/i&gt; Alternate Money Bill
                                                </option>
                                                <option value="fas fa-money-bill-wave" <?php if($info['icon'] == 'fas fa-money-bill-wave'){ echo 'selected'; } ?> data-select2-id="select2-data-865-n7fy">
                                                    &lt;i class="fas fa-money-bill-wave"&gt;&lt;/i&gt; Wavy Money Bill
                                                </option>
                                                <option value="fas fa-money-bill-wave-alt" <?php if($info['icon'] == 'fas fa-money-bill-wave-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-866-kfxy">
                                                    &lt;i class="fas fa-money-bill-wave-alt"&gt;&lt;/i&gt; Alternate Wavy Money Bill
                                                </option>
                                                <option value="fas fa-money-check" <?php if($info['icon'] == 'fas fa-money-check'){ echo 'selected'; } ?> data-select2-id="select2-data-867-txr2">
                                                    &lt;i class="fas fa-money-check"&gt;&lt;/i&gt; Money Check
                                                </option>
                                                <option value="fas fa-money-check-alt" <?php if($info['icon'] == 'fas fa-money-check-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-868-h0a8">
                                                    &lt;i class="fas fa-money-check-alt"&gt;&lt;/i&gt; Alternate Money Check
                                                </option>
                                                <option value="fas fa-moon" <?php if($info['icon'] == 'fas fa-moon'){ echo 'selected'; } ?> data-select2-id="select2-data-870-derg">
                                                    &lt;i class="fas fa-moon"&gt;&lt;/i&gt; Moon
                                                </option>
                                                <option value="fas fa-motorcycle" <?php if($info['icon'] == 'fas fa-motorcycle'){ echo 'selected'; } ?> data-select2-id="select2-data-873-4vog">
                                                    &lt;i class="fas fa-motorcycle"&gt;&lt;/i&gt; Motorcycle
                                                </option>
                                                <option value="fas fa-mouse-pointer" <?php if($info['icon'] == 'fas fa-mouse-pointer'){ echo 'selected'; } ?> data-select2-id="select2-data-876-thie">
                                                    &lt;i class="fas fa-mouse-pointer"&gt;&lt;/i&gt; Mouse Pointer
                                                </option>
                                                <option value="fas fa-music" <?php if($info['icon'] == 'fas fa-music'){ echo 'selected'; } ?> data-select2-id="select2-data-878-zmfv">
                                                    &lt;i class="fas fa-music"&gt;&lt;/i&gt; Music
                                                </option>
                                                <option value="fab fa-napster" <?php if($info['icon'] == 'fab fa-napster'){ echo 'selected'; } ?> data-select2-id="select2-data-879-1ezv">
                                                    &lt;i class="fab fa-napster"&gt;&lt;/i&gt; Napster
                                                </option>
                                                <option value="fas fa-neuter" <?php if($info['icon'] == 'fas fa-neuter'){ echo 'selected'; } ?> data-select2-id="select2-data-882-dz98">
                                                    &lt;i class="fas fa-neuter"&gt;&lt;/i&gt; Neuter
                                                </option>
                                                <option value="fas fa-newspaper" <?php if($info['icon'] == 'fas fa-newspaper'){ echo 'selected'; } ?> data-select2-id="select2-data-883-paj8">
                                                    &lt;i class="fas fa-newspaper"&gt;&lt;/i&gt; Newspaper
                                                </option>
                                                <option value="fab fa-node" <?php if($info['icon'] == 'fab fa-node'){ echo 'selected'; } ?> data-select2-id="select2-data-885-0yrn">
                                                    &lt;i class="fab fa-node"&gt;&lt;/i&gt; Node.js
                                                </option>
                                                <option value="fab fa-node-js" <?php if($info['icon'] == 'fab fa-node-js'){ echo 'selected'; } ?> data-select2-id="select2-data-886-blfb">
                                                    &lt;i class="fab fa-node-js"&gt;&lt;/i&gt; Node.js JS
                                                </option>
                                                <option value="fas fa-not-equal" <?php if($info['icon'] == 'fas fa-not-equal'){ echo 'selected'; } ?> data-select2-id="select2-data-887-dsro">
                                                    &lt;i class="fas fa-not-equal"&gt;&lt;/i&gt; Not Equal
                                                </option>
                                                <option value="fas fa-notes-medical" <?php if($info['icon'] == 'fas fa-notes-medical'){ echo 'selected'; } ?> data-select2-id="select2-data-888-s32v">
                                                    &lt;i class="fas fa-notes-medical"&gt;&lt;/i&gt; Medical Notes
                                                </option>
                                                <option value="fab fa-npm" <?php if($info['icon'] == 'fab fa-npm'){ echo 'selected'; } ?> data-select2-id="select2-data-889-d6kh">
                                                    &lt;i class="fab fa-npm"&gt;&lt;/i&gt; npm
                                                </option>
                                                <option value="fab fa-ns8" <?php if($info['icon'] == 'fab fa-ns8'){ echo 'selected'; } ?> data-select2-id="select2-data-890-ecce">
                                                    &lt;i class="fab fa-ns8"&gt;&lt;/i&gt; NS8
                                                </option>
                                                <option value="fab fa-nutritionix" <?php if($info['icon'] == 'fab fa-nutritionix'){ echo 'selected'; } ?> data-select2-id="select2-data-891-22xl">
                                                    &lt;i class="fab fa-nutritionix"&gt;&lt;/i&gt; Nutritionix
                                                </option>
                                                <option value="fas fa-object-group" <?php if($info['icon'] == 'fas fa-object-group'){ echo 'selected'; } ?> data-select2-id="select2-data-892-yu6i">
                                                    &lt;i class="fas fa-object-group"&gt;&lt;/i&gt; Object Group
                                                </option>
                                                <option value="fas fa-object-ungroup" <?php if($info['icon'] == 'fas fa-object-ungroup'){ echo 'selected'; } ?> data-select2-id="select2-data-893-t4vj">
                                                    &lt;i class="fas fa-object-ungroup"&gt;&lt;/i&gt; Object Ungroup
                                                </option>
                                                <option value="fab fa-odnoklassniki" <?php if($info['icon'] == 'fab fa-odnoklassniki'){ echo 'selected'; } ?> data-select2-id="select2-data-895-i6xs">
                                                    &lt;i class="fab fa-odnoklassniki"&gt;&lt;/i&gt; Odnoklassniki
                                                </option>
                                                <option value="fab fa-odnoklassniki-square" <?php if($info['icon'] == 'fab fa-odnoklassniki-square'){ echo 'selected'; } ?> data-select2-id="select2-data-896-cfuy">
                                                    &lt;i class="fab fa-odnoklassniki-square"&gt;&lt;/i&gt; Odnoklassniki Square
                                                </option>
                                                <option value="fab fa-old-republic" <?php if($info['icon'] == 'fab fa-old-republic'){ echo 'selected'; } ?> data-select2-id="select2-data-898-43ut">
                                                    &lt;i class="fab fa-old-republic"&gt;&lt;/i&gt; Old Republic
                                                </option>
                                                <option value="fab fa-opencart" <?php if($info['icon'] == 'fab fa-opencart'){ echo 'selected'; } ?> data-select2-id="select2-data-900-re0y">
                                                    &lt;i class="fab fa-opencart"&gt;&lt;/i&gt; OpenCart
                                                </option>
                                                <option value="fab fa-openid" <?php if($info['icon'] == 'fab fa-openid'){ echo 'selected'; } ?> data-select2-id="select2-data-901-bvha">
                                                    &lt;i class="fab fa-openid"&gt;&lt;/i&gt; OpenID
                                                </option>
                                                <option value="fab fa-opera" <?php if($info['icon'] == 'fab fa-opera'){ echo 'selected'; } ?> data-select2-id="select2-data-902-6j2a">
                                                    &lt;i class="fab fa-opera"&gt;&lt;/i&gt; Opera
                                                </option>
                                                <option value="fab fa-optin-monster" <?php if($info['icon'] == 'fab fa-optin-monster'){ echo 'selected'; } ?> data-select2-id="select2-data-903-3ydq">
                                                    &lt;i class="fab fa-optin-monster"&gt;&lt;/i&gt; Optin Monster
                                                </option>
                                                <option value="fab fa-osi" <?php if($info['icon'] == 'fab fa-osi'){ echo 'selected'; } ?> data-select2-id="select2-data-905-mi5h">
                                                    &lt;i class="fab fa-osi"&gt;&lt;/i&gt; Open Source Initiative
                                                </option>
                                                <option value="fas fa-outdent" <?php if($info['icon'] == 'fas fa-outdent'){ echo 'selected'; } ?> data-select2-id="select2-data-907-mrtl">
                                                    &lt;i class="fas fa-outdent"&gt;&lt;/i&gt; Outdent
                                                </option>
                                                <option value="fab fa-page4" <?php if($info['icon'] == 'fab fa-page4'){ echo 'selected'; } ?> data-select2-id="select2-data-908-pvcg">
                                                    &lt;i class="fab fa-page4"&gt;&lt;/i&gt; page4 Corporation
                                                </option>
                                                <option value="fab fa-pagelines" <?php if($info['icon'] == 'fab fa-pagelines'){ echo 'selected'; } ?> data-select2-id="select2-data-909-u7m6">
                                                    &lt;i class="fab fa-pagelines"&gt;&lt;/i&gt; Pagelines
                                                </option>
                                                <option value="fas fa-paint-brush" <?php if($info['icon'] == 'fas fa-paint-brush'){ echo 'selected'; } ?> data-select2-id="select2-data-911-bqir">
                                                    &lt;i class="fas fa-paint-brush"&gt;&lt;/i&gt; Paint Brush
                                                </option>
                                                <option value="fas fa-palette" <?php if($info['icon'] == 'fas fa-palette'){ echo 'selected'; } ?> data-select2-id="select2-data-913-owze">
                                                    &lt;i class="fas fa-palette"&gt;&lt;/i&gt; Palette
                                                </option>
                                                <option value="fab fa-palfed" <?php if($info['icon'] == 'fab fa-palfed'){ echo 'selected'; } ?> data-select2-id="select2-data-914-8txx">
                                                    &lt;i class="fab fa-palfed"&gt;&lt;/i&gt; Palfed
                                                </option>
                                                <option value="fas fa-pallet" <?php if($info['icon'] == 'fas fa-pallet'){ echo 'selected'; } ?> data-select2-id="select2-data-915-x7g0">
                                                    &lt;i class="fas fa-pallet"&gt;&lt;/i&gt; Pallet
                                                </option>
                                                <option value="fas fa-paper-plane" <?php if($info['icon'] == 'fas fa-paper-plane'){ echo 'selected'; } ?> data-select2-id="select2-data-916-wsn4">
                                                    &lt;i class="fas fa-paper-plane"&gt;&lt;/i&gt; Paper Plane
                                                </option>
                                                <option value="fas fa-paperclip" <?php if($info['icon'] == 'fas fa-paperclip'){ echo 'selected'; } ?> data-select2-id="select2-data-917-fo37">
                                                    &lt;i class="fas fa-paperclip"&gt;&lt;/i&gt; Paperclip
                                                </option>
                                                <option value="fas fa-parachute-box" <?php if($info['icon'] == 'fas fa-parachute-box'){ echo 'selected'; } ?> data-select2-id="select2-data-918-nchj">
                                                    &lt;i class="fas fa-parachute-box"&gt;&lt;/i&gt; Parachute Box
                                                </option>
                                                <option value="fas fa-paragraph" <?php if($info['icon'] == 'fas fa-paragraph'){ echo 'selected'; } ?> data-select2-id="select2-data-919-5qtc">
                                                    &lt;i class="fas fa-paragraph"&gt;&lt;/i&gt; paragraph
                                                </option>
                                                <option value="fas fa-parking" <?php if($info['icon'] == 'fas fa-parking'){ echo 'selected'; } ?> data-select2-id="select2-data-920-lyvb">
                                                    &lt;i class="fas fa-parking"&gt;&lt;/i&gt; Parking
                                                </option>
                                                <option value="fas fa-paste" <?php if($info['icon'] == 'fas fa-paste'){ echo 'selected'; } ?> data-select2-id="select2-data-923-vdlw">
                                                    &lt;i class="fas fa-paste"&gt;&lt;/i&gt; Paste
                                                </option>
                                                <option value="fab fa-patreon" <?php if($info['icon'] == 'fab fa-patreon'){ echo 'selected'; } ?> data-select2-id="select2-data-924-61cp">
                                                    &lt;i class="fab fa-patreon"&gt;&lt;/i&gt; Patreon
                                                </option>
                                                <option value="fas fa-pause" <?php if($info['icon'] == 'fas fa-pause'){ echo 'selected'; } ?> data-select2-id="select2-data-925-i086">
                                                    &lt;i class="fas fa-pause"&gt;&lt;/i&gt; pause
                                                </option>
                                                <option value="fas fa-pause-circle" <?php if($info['icon'] == 'fas fa-pause-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-926-ahfr">
                                                    &lt;i class="fas fa-pause-circle"&gt;&lt;/i&gt; Pause Circle
                                                </option>
                                                <option value="fas fa-paw" <?php if($info['icon'] == 'fas fa-paw'){ echo 'selected'; } ?> data-select2-id="select2-data-927-caqz">
                                                    &lt;i class="fas fa-paw"&gt;&lt;/i&gt; Paw
                                                </option>
                                                <option value="fab fa-paypal" <?php if($info['icon'] == 'fab fa-paypal'){ echo 'selected'; } ?> data-select2-id="select2-data-928-u87v">
                                                    &lt;i class="fab fa-paypal"&gt;&lt;/i&gt; Paypal
                                                </option>
                                                <option value="fas fa-pen-square" <?php if($info['icon'] == 'fas fa-pen-square'){ echo 'selected'; } ?> data-select2-id="select2-data-934-zjey">
                                                    &lt;i class="fas fa-pen-square"&gt;&lt;/i&gt; Pen Square
                                                </option>
                                                <option value="fas fa-pencil-alt" <?php if($info['icon'] == 'fas fa-pencil-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-935-9wlq">
                                                    &lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt; Alternate Pencil
                                                </option>
                                                <option value="fas fa-people-carry" <?php if($info['icon'] == 'fas fa-people-carry'){ echo 'selected'; } ?> data-select2-id="select2-data-939-k5kp">
                                                    &lt;i class="fas fa-people-carry"&gt;&lt;/i&gt; People Carry
                                                </option>
                                                <option value="fas fa-percent" <?php if($info['icon'] == 'fas fa-percent'){ echo 'selected'; } ?> data-select2-id="select2-data-942-d3th">
                                                    &lt;i class="fas fa-percent"&gt;&lt;/i&gt; Percent
                                                </option>
                                                <option value="fas fa-percentage" <?php if($info['icon'] == 'fas fa-percentage'){ echo 'selected'; } ?> data-select2-id="select2-data-943-cb9h">
                                                    &lt;i class="fas fa-percentage"&gt;&lt;/i&gt; Percentage
                                                </option>
                                                <option value="fab fa-periscope" <?php if($info['icon'] == 'fab fa-periscope'){ echo 'selected'; } ?> data-select2-id="select2-data-944-rsi5">
                                                    &lt;i class="fab fa-periscope"&gt;&lt;/i&gt; Periscope
                                                </option>
                                                <option value="fab fa-phabricator" <?php if($info['icon'] == 'fab fa-phabricator'){ echo 'selected'; } ?> data-select2-id="select2-data-946-vqel">
                                                    &lt;i class="fab fa-phabricator"&gt;&lt;/i&gt; Phabricator
                                                </option>
                                                <option value="fab fa-phoenix-framework" <?php if($info['icon'] == 'fab fa-phoenix-framework'){ echo 'selected'; } ?> data-select2-id="select2-data-947-iuv7">
                                                    &lt;i class="fab fa-phoenix-framework"&gt;&lt;/i&gt; Phoenix Framework
                                                </option>
                                                <option value="fab fa-phoenix-squadron" <?php if($info['icon'] == 'fab fa-phoenix-squadron'){ echo 'selected'; } ?> data-select2-id="select2-data-948-1btj">
                                                    &lt;i class="fab fa-phoenix-squadron"&gt;&lt;/i&gt; Phoenix Squadron
                                                </option>
                                                <option value="fas fa-phone" <?php if($info['icon'] == 'fas fa-phone'){ echo 'selected'; } ?> data-select2-id="select2-data-949-0rr7">
                                                    &lt;i class="fas fa-phone"&gt;&lt;/i&gt; Phone
                                                </option>
                                                <option value="fas fa-phone-slash" <?php if($info['icon'] == 'fas fa-phone-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-951-5i02">
                                                    &lt;i class="fas fa-phone-slash"&gt;&lt;/i&gt; Phone Slash
                                                </option>
                                                <option value="fas fa-phone-square" <?php if($info['icon'] == 'fas fa-phone-square'){ echo 'selected'; } ?> data-select2-id="select2-data-952-z083">
                                                    &lt;i class="fas fa-phone-square"&gt;&lt;/i&gt; Phone Square
                                                </option>
                                                <option value="fas fa-phone-volume" <?php if($info['icon'] == 'fas fa-phone-volume'){ echo 'selected'; } ?> data-select2-id="select2-data-954-e6p8">
                                                    &lt;i class="fas fa-phone-volume"&gt;&lt;/i&gt; Phone Volume
                                                </option>
                                                <option value="fab fa-php" <?php if($info['icon'] == 'fab fa-php'){ echo 'selected'; } ?> data-select2-id="select2-data-956-mksr">
                                                    &lt;i class="fab fa-php"&gt;&lt;/i&gt; PHP
                                                </option>
                                                <option value="fab fa-pied-piper" <?php if($info['icon'] == 'fab fa-pied-piper'){ echo 'selected'; } ?> data-select2-id="select2-data-957-ggm3">
                                                    &lt;i class="fab fa-pied-piper"&gt;&lt;/i&gt; Pied Piper Logo
                                                </option>
                                                <option value="fab fa-pied-piper-alt" <?php if($info['icon'] == 'fab fa-pied-piper-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-958-42f5">
                                                    &lt;i class="fab fa-pied-piper-alt"&gt;&lt;/i&gt; Alternate Pied Piper Logo (Old)
                                                </option>
                                                <option value="fab fa-pied-piper-hat" <?php if($info['icon'] == 'fab fa-pied-piper-hat'){ echo 'selected'; } ?> data-select2-id="select2-data-959-7yrc">
                                                    &lt;i class="fab fa-pied-piper-hat"&gt;&lt;/i&gt; Pied Piper Hat (Old)
                                                </option>
                                                <option value="fab fa-pied-piper-pp" <?php if($info['icon'] == 'fab fa-pied-piper-pp'){ echo 'selected'; } ?> data-select2-id="select2-data-960-vsl0">
                                                    &lt;i class="fab fa-pied-piper-pp"&gt;&lt;/i&gt; Pied Piper PP Logo (Old)
                                                </option>
                                                <option value="fas fa-piggy-bank" <?php if($info['icon'] == 'fas fa-piggy-bank'){ echo 'selected'; } ?> data-select2-id="select2-data-962-w24o">
                                                    &lt;i class="fas fa-piggy-bank"&gt;&lt;/i&gt; Piggy Bank
                                                </option>
                                                <option value="fas fa-pills" <?php if($info['icon'] == 'fas fa-pills'){ echo 'selected'; } ?> data-select2-id="select2-data-963-3vaf">
                                                    &lt;i class="fas fa-pills"&gt;&lt;/i&gt; Pills
                                                </option>
                                                <option value="fab fa-pinterest" <?php if($info['icon'] == 'fab fa-pinterest'){ echo 'selected'; } ?> data-select2-id="select2-data-964-cp99">
                                                    &lt;i class="fab fa-pinterest"&gt;&lt;/i&gt; Pinterest
                                                </option>
                                                <option value="fab fa-pinterest-p" <?php if($info['icon'] == 'fab fa-pinterest-p'){ echo 'selected'; } ?> data-select2-id="select2-data-965-ovcp">
                                                    &lt;i class="fab fa-pinterest-p"&gt;&lt;/i&gt; Pinterest P
                                                </option>
                                                <option value="fab fa-pinterest-square" <?php if($info['icon'] == 'fab fa-pinterest-square'){ echo 'selected'; } ?> data-select2-id="select2-data-966-uq7y">
                                                    &lt;i class="fab fa-pinterest-square"&gt;&lt;/i&gt; Pinterest Square
                                                </option>
                                                <option value="fas fa-plane" <?php if($info['icon'] == 'fas fa-plane'){ echo 'selected'; } ?> data-select2-id="select2-data-969-h6mu">
                                                    &lt;i class="fas fa-plane"&gt;&lt;/i&gt; plane
                                                </option>
                                                <option value="fas fa-play" <?php if($info['icon'] == 'fas fa-play'){ echo 'selected'; } ?> data-select2-id="select2-data-973-hrs5">
                                                    &lt;i class="fas fa-play"&gt;&lt;/i&gt; play
                                                </option>
                                                <option value="fas fa-play-circle" <?php if($info['icon'] == 'fas fa-play-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-974-nd71">
                                                    &lt;i class="fas fa-play-circle"&gt;&lt;/i&gt; Play Circle
                                                </option>
                                                <option value="fab fa-playstation" <?php if($info['icon'] == 'fab fa-playstation'){ echo 'selected'; } ?> data-select2-id="select2-data-975-01w9">
                                                    &lt;i class="fab fa-playstation"&gt;&lt;/i&gt; PlayStation
                                                </option>
                                                <option value="fas fa-plug" <?php if($info['icon'] == 'fas fa-plug'){ echo 'selected'; } ?> data-select2-id="select2-data-976-lyn5">
                                                    &lt;i class="fas fa-plug"&gt;&lt;/i&gt; Plug
                                                </option>
                                                <option value="fas fa-plus" <?php if($info['icon'] == 'fas fa-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-977-qmos">
                                                    &lt;i class="fas fa-plus"&gt;&lt;/i&gt; plus
                                                </option>
                                                <option value="fas fa-plus-circle" <?php if($info['icon'] == 'fas fa-plus-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-978-h5xd">
                                                    &lt;i class="fas fa-plus-circle"&gt;&lt;/i&gt; Plus Circle
                                                </option>
                                                <option value="fas fa-plus-square" <?php if($info['icon'] == 'fas fa-plus-square'){ echo 'selected'; } ?> data-select2-id="select2-data-979-9is8">
                                                    &lt;i class="fas fa-plus-square"&gt;&lt;/i&gt; Plus Square
                                                </option>
                                                <option value="fas fa-podcast" <?php if($info['icon'] == 'fas fa-podcast'){ echo 'selected'; } ?> data-select2-id="select2-data-980-us4j">
                                                    &lt;i class="fas fa-podcast"&gt;&lt;/i&gt; Podcast
                                                </option>
                                                <option value="fas fa-poo" <?php if($info['icon'] == 'fas fa-poo'){ echo 'selected'; } ?> data-select2-id="select2-data-983-mlm1">
                                                    &lt;i class="fas fa-poo"&gt;&lt;/i&gt; Poo
                                                </option>
                                                <option value="fas fa-portrait" <?php if($info['icon'] == 'fas fa-portrait'){ echo 'selected'; } ?> data-select2-id="select2-data-986-9vrv">
                                                    &lt;i class="fas fa-portrait"&gt;&lt;/i&gt; Portrait
                                                </option>
                                                <option value="fas fa-pound-sign" <?php if($info['icon'] == 'fas fa-pound-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-987-spj2">
                                                    &lt;i class="fas fa-pound-sign"&gt;&lt;/i&gt; Pound Sign
                                                </option>
                                                <option value="fas fa-power-off" <?php if($info['icon'] == 'fas fa-power-off'){ echo 'selected'; } ?> data-select2-id="select2-data-988-7c1x">
                                                    &lt;i class="fas fa-power-off"&gt;&lt;/i&gt; Power Off
                                                </option>
                                                <option value="fas fa-prescription-bottle" <?php if($info['icon'] == 'fas fa-prescription-bottle'){ echo 'selected'; } ?> data-select2-id="select2-data-992-6ypn">
                                                    &lt;i class="fas fa-prescription-bottle"&gt;&lt;/i&gt; Prescription Bottle
                                                </option>
                                                <option value="fas fa-prescription-bottle-alt" <?php if($info['icon'] == 'fas fa-prescription-bottle-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-993-aqr2">
                                                    &lt;i class="fas fa-prescription-bottle-alt"&gt;&lt;/i&gt; Alternate Prescription Bottle
                                                </option>
                                                <option value="fas fa-print" <?php if($info['icon'] == 'fas fa-print'){ echo 'selected'; } ?> data-select2-id="select2-data-994-dhw2">
                                                    &lt;i class="fas fa-print"&gt;&lt;/i&gt; print
                                                </option>
                                                <option value="fas fa-procedures" <?php if($info['icon'] == 'fas fa-procedures'){ echo 'selected'; } ?> data-select2-id="select2-data-995-eyft">
                                                    &lt;i class="fas fa-procedures"&gt;&lt;/i&gt; Procedures
                                                </option>
                                                <option value="fab fa-product-hunt" <?php if($info['icon'] == 'fab fa-product-hunt'){ echo 'selected'; } ?> data-select2-id="select2-data-996-2op7">
                                                    &lt;i class="fab fa-product-hunt"&gt;&lt;/i&gt; Product Hunt
                                                </option>
                                                <option value="fas fa-project-diagram" <?php if($info['icon'] == 'fas fa-project-diagram'){ echo 'selected'; } ?> data-select2-id="select2-data-997-1686">
                                                    &lt;i class="fas fa-project-diagram"&gt;&lt;/i&gt; Project Diagram
                                                </option>
                                                <option value="fab fa-pushed" <?php if($info['icon'] == 'fab fa-pushed'){ echo 'selected'; } ?> data-select2-id="select2-data-1000-1zjp">
                                                    &lt;i class="fab fa-pushed"&gt;&lt;/i&gt; Pushed
                                                </option>
                                                <option value="fas fa-puzzle-piece" <?php if($info['icon'] == 'fas fa-puzzle-piece'){ echo 'selected'; } ?> data-select2-id="select2-data-1001-wj7r">
                                                    &lt;i class="fas fa-puzzle-piece"&gt;&lt;/i&gt; Puzzle Piece
                                                </option>
                                                <option value="fab fa-python" <?php if($info['icon'] == 'fab fa-python'){ echo 'selected'; } ?> data-select2-id="select2-data-1002-hy0w">
                                                    &lt;i class="fab fa-python"&gt;&lt;/i&gt; Python
                                                </option>
                                                <option value="fab fa-qq" <?php if($info['icon'] == 'fab fa-qq'){ echo 'selected'; } ?> data-select2-id="select2-data-1003-5yl2">
                                                    &lt;i class="fab fa-qq"&gt;&lt;/i&gt; QQ
                                                </option>
                                                <option value="fas fa-qrcode" <?php if($info['icon'] == 'fas fa-qrcode'){ echo 'selected'; } ?> data-select2-id="select2-data-1004-n1d3">
                                                    &lt;i class="fas fa-qrcode"&gt;&lt;/i&gt; qrcode
                                                </option>
                                                <option value="fas fa-question" <?php if($info['icon'] == 'fas fa-question'){ echo 'selected'; } ?> data-select2-id="select2-data-1005-b3c1">
                                                    &lt;i class="fas fa-question"&gt;&lt;/i&gt; Question
                                                </option>
                                                <option value="fas fa-question-circle" <?php if($info['icon'] == 'fas fa-question-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-1006-3zsv">
                                                    &lt;i class="fas fa-question-circle"&gt;&lt;/i&gt; Question Circle
                                                </option>
                                                <option value="fas fa-quidditch" <?php if($info['icon'] == 'fas fa-quidditch'){ echo 'selected'; } ?> data-select2-id="select2-data-1007-j0va">
                                                    &lt;i class="fas fa-quidditch"&gt;&lt;/i&gt; Quidditch
                                                </option>
                                                <option value="fab fa-quinscape" <?php if($info['icon'] == 'fab fa-quinscape'){ echo 'selected'; } ?> data-select2-id="select2-data-1008-519y">
                                                    &lt;i class="fab fa-quinscape"&gt;&lt;/i&gt; QuinScape
                                                </option>
                                                <option value="fab fa-quora" <?php if($info['icon'] == 'fab fa-quora'){ echo 'selected'; } ?> data-select2-id="select2-data-1009-m45a">
                                                    &lt;i class="fab fa-quora"&gt;&lt;/i&gt; Quora
                                                </option>
                                                <option value="fas fa-quote-left" <?php if($info['icon'] == 'fas fa-quote-left'){ echo 'selected'; } ?> data-select2-id="select2-data-1010-1tbz">
                                                    &lt;i class="fas fa-quote-left"&gt;&lt;/i&gt; quote-left
                                                </option>
                                                <option value="fas fa-quote-right" <?php if($info['icon'] == 'fas fa-quote-right'){ echo 'selected'; } ?> data-select2-id="select2-data-1011-h3sm">
                                                    &lt;i class="fas fa-quote-right"&gt;&lt;/i&gt; quote-right
                                                </option>
                                                <option value="fab fa-r-project" <?php if($info['icon'] == 'fab fa-r-project'){ echo 'selected'; } ?> data-select2-id="select2-data-1013-novl">
                                                    &lt;i class="fab fa-r-project"&gt;&lt;/i&gt; R Project
                                                </option>
                                                <option value="fas fa-random" <?php if($info['icon'] == 'fas fa-random'){ echo 'selected'; } ?> data-select2-id="select2-data-1017-2nv0">
                                                    &lt;i class="fas fa-random"&gt;&lt;/i&gt; random
                                                </option>
                                                <option value="fab fa-ravelry" <?php if($info['icon'] == 'fab fa-ravelry'){ echo 'selected'; } ?> data-select2-id="select2-data-1019-9mv6">
                                                    &lt;i class="fab fa-ravelry"&gt;&lt;/i&gt; Ravelry
                                                </option>
                                                <option value="fab fa-react" <?php if($info['icon'] == 'fab fa-react'){ echo 'selected'; } ?> data-select2-id="select2-data-1020-1cvx">
                                                    &lt;i class="fab fa-react"&gt;&lt;/i&gt; React
                                                </option>
                                                <option value="fab fa-readme" <?php if($info['icon'] == 'fab fa-readme'){ echo 'selected'; } ?> data-select2-id="select2-data-1022-bu5i">
                                                    &lt;i class="fab fa-readme"&gt;&lt;/i&gt; ReadMe
                                                </option>
                                                <option value="fab fa-rebel" <?php if($info['icon'] == 'fab fa-rebel'){ echo 'selected'; } ?> data-select2-id="select2-data-1023-2clk">
                                                    &lt;i class="fab fa-rebel"&gt;&lt;/i&gt; Rebel Alliance
                                                </option>
                                                <option value="fas fa-receipt" <?php if($info['icon'] == 'fas fa-receipt'){ echo 'selected'; } ?> data-select2-id="select2-data-1024-nr7z">
                                                    &lt;i class="fas fa-receipt"&gt;&lt;/i&gt; Receipt
                                                </option>
                                                <option value="fas fa-recycle" <?php if($info['icon'] == 'fas fa-recycle'){ echo 'selected'; } ?> data-select2-id="select2-data-1026-n5pq">
                                                    &lt;i class="fas fa-recycle"&gt;&lt;/i&gt; Recycle
                                                </option>
                                                <option value="fab fa-red-river" <?php if($info['icon'] == 'fab fa-red-river'){ echo 'selected'; } ?> data-select2-id="select2-data-1027-5jpc">
                                                    &lt;i class="fab fa-red-river"&gt;&lt;/i&gt; red river
                                                </option>
                                                <option value="fab fa-reddit" <?php if($info['icon'] == 'fab fa-reddit'){ echo 'selected'; } ?> data-select2-id="select2-data-1028-ix8i">
                                                    &lt;i class="fab fa-reddit"&gt;&lt;/i&gt; reddit Logo
                                                </option>
                                                <option value="fab fa-reddit-alien" <?php if($info['icon'] == 'fab fa-reddit-alien'){ echo 'selected'; } ?> data-select2-id="select2-data-1029-6062">
                                                    &lt;i class="fab fa-reddit-alien"&gt;&lt;/i&gt; reddit Alien
                                                </option>
                                                <option value="fab fa-reddit-square" <?php if($info['icon'] == 'fab fa-reddit-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1030-amz7">
                                                    &lt;i class="fab fa-reddit-square"&gt;&lt;/i&gt; reddit Square
                                                </option>
                                                <option value="fas fa-redo" <?php if($info['icon'] == 'fas fa-redo'){ echo 'selected'; } ?> data-select2-id="select2-data-1032-71jl">
                                                    &lt;i class="fas fa-redo"&gt;&lt;/i&gt; Redo
                                                </option>
                                                <option value="fas fa-redo-alt" <?php if($info['icon'] == 'fas fa-redo-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1033-89qd">
                                                    &lt;i class="fas fa-redo-alt"&gt;&lt;/i&gt; Alternate Redo
                                                </option>
                                                <option value="fas fa-registered" <?php if($info['icon'] == 'fas fa-registered'){ echo 'selected'; } ?> data-select2-id="select2-data-1034-qix2">
                                                    &lt;i class="fas fa-registered"&gt;&lt;/i&gt; Registered Trademark
                                                </option>
                                                <option value="fab fa-renren" <?php if($info['icon'] == 'fab fa-renren'){ echo 'selected'; } ?> data-select2-id="select2-data-1036-vjd8">
                                                    &lt;i class="fab fa-renren"&gt;&lt;/i&gt; Renren
                                                </option>
                                                <option value="fas fa-reply" <?php if($info['icon'] == 'fas fa-reply'){ echo 'selected'; } ?> data-select2-id="select2-data-1037-s0tz">
                                                    &lt;i class="fas fa-reply"&gt;&lt;/i&gt; Reply
                                                </option>
                                                <option value="fas fa-reply-all" <?php if($info['icon'] == 'fas fa-reply-all'){ echo 'selected'; } ?> data-select2-id="select2-data-1038-7ki9">
                                                    &lt;i class="fas fa-reply-all"&gt;&lt;/i&gt; reply-all
                                                </option>
                                                <option value="fab fa-replyd" <?php if($info['icon'] == 'fab fa-replyd'){ echo 'selected'; } ?> data-select2-id="select2-data-1039-nz0r">
                                                    &lt;i class="fab fa-replyd"&gt;&lt;/i&gt; replyd
                                                </option>
                                                <option value="fab fa-researchgate" <?php if($info['icon'] == 'fab fa-researchgate'){ echo 'selected'; } ?> data-select2-id="select2-data-1041-70vi">
                                                    &lt;i class="fab fa-researchgate"&gt;&lt;/i&gt; Researchgate
                                                </option>
                                                <option value="fab fa-resolving" <?php if($info['icon'] == 'fab fa-resolving'){ echo 'selected'; } ?> data-select2-id="select2-data-1042-1pml">
                                                    &lt;i class="fab fa-resolving"&gt;&lt;/i&gt; Resolving
                                                </option>
                                                <option value="fas fa-retweet" <?php if($info['icon'] == 'fab fa-resolving'){ echo 'selected'; } ?> data-select2-id="select2-data-1044-3btn">
                                                    &lt;i class="fas fa-retweet"&gt;&lt;/i&gt; Retweet
                                                </option>
                                                <option value="fas fa-ribbon" <?php if($info['icon'] == 'fas fa-ribbon'){ echo 'selected'; } ?> data-select2-id="select2-data-1046-t79t">
                                                    &lt;i class="fas fa-ribbon"&gt;&lt;/i&gt; Ribbon
                                                </option>
                                                <option value="fas fa-road" <?php if($info['icon'] == 'fas fa-road'){ echo 'selected'; } ?> data-select2-id="select2-data-1048-ngii">
                                                    &lt;i class="fas fa-road"&gt;&lt;/i&gt; road
                                                </option>
                                                <option value="fas fa-robot" <?php if($info['icon'] == 'fas fa-robot'){ echo 'selected'; } ?> data-select2-id="select2-data-1049-sqxk">
                                                    &lt;i class="fas fa-robot"&gt;&lt;/i&gt; Robot
                                                </option>
                                                <option value="fas fa-rocket" <?php if($info['icon'] == 'fas fa-rocket'){ echo 'selected'; } ?> data-select2-id="select2-data-1050-onqo">
                                                    &lt;i class="fas fa-rocket"&gt;&lt;/i&gt; rocket
                                                </option>
                                                <option value="fab fa-rocketchat" <?php if($info['icon'] == 'fab fa-rocketchat'){ echo 'selected'; } ?> data-select2-id="select2-data-1051-svav">
                                                    &lt;i class="fab fa-rocketchat"&gt;&lt;/i&gt; Rocket.Chat
                                                </option>
                                                <option value="fab fa-rockrms" <?php if($info['icon'] == 'fab fa-rockrms'){ echo 'selected'; } ?> data-select2-id="select2-data-1052-ksfc">
                                                    &lt;i class="fab fa-rockrms"&gt;&lt;/i&gt; Rockrms
                                                </option>
                                                <option value="fas fa-rss" <?php if($info['icon'] == 'fas fa-rss'){ echo 'selected'; } ?> data-select2-id="select2-data-1054-izdg">
                                                    &lt;i class="fas fa-rss"&gt;&lt;/i&gt; rss
                                                </option>
                                                <option value="fas fa-rss-square" <?php if($info['icon'] == 'fas fa-rss-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1055-245o">
                                                    &lt;i class="fas fa-rss-square"&gt;&lt;/i&gt; RSS Square
                                                </option>
                                                <option value="fas fa-ruble-sign" <?php if($info['icon'] == 'fas fa-ruble-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1056-8koo">
                                                    &lt;i class="fas fa-ruble-sign"&gt;&lt;/i&gt; Ruble Sign
                                                </option>
                                                <option value="fas fa-ruler" <?php if($info['icon'] == 'fas fa-ruler'){ echo 'selected'; } ?> data-select2-id="select2-data-1057-sdij">
                                                    &lt;i class="fas fa-ruler"&gt;&lt;/i&gt; Ruler
                                                </option>
                                                <option value="fas fa-ruler-combined" <?php if($info['icon'] == 'fas fa-ruler-combined'){ echo 'selected'; } ?> data-select2-id="select2-data-1058-espv">
                                                    &lt;i class="fas fa-ruler-combined"&gt;&lt;/i&gt; Ruler Combined
                                                </option>
                                                <option value="fas fa-ruler-horizontal" <?php if($info['icon'] == 'fas fa-ruler-horizontal'){ echo 'selected'; } ?> data-select2-id="select2-data-1059-320p">
                                                    &lt;i class="fas fa-ruler-horizontal"&gt;&lt;/i&gt; Ruler Horizontal
                                                </option>
                                                <option value="fas fa-ruler-vertical" <?php if($info['icon'] == 'fas fa-ruler-vertical'){ echo 'selected'; } ?> data-select2-id="select2-data-1060-cuje">
                                                    &lt;i class="fas fa-ruler-vertical"&gt;&lt;/i&gt; Ruler Vertical
                                                </option>
                                                <option value="fas fa-rupee-sign" <?php if($info['icon'] == 'fas fa-rupee-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1062-m5q6">
                                                    &lt;i class="fas fa-rupee-sign"&gt;&lt;/i&gt; Indian Rupee Sign
                                                </option>
                                                <option value="fab fa-safari" <?php if($info['icon'] == 'fab fa-safari'){ echo 'selected'; } ?> data-select2-id="select2-data-1066-gg4w">
                                                    &lt;i class="fab fa-safari"&gt;&lt;/i&gt; Safari
                                                </option>
                                                <option value="fab fa-sass" <?php if($info['icon'] == 'fab fa-sass'){ echo 'selected'; } ?> data-select2-id="select2-data-1068-ll0k">
                                                    &lt;i class="fab fa-sass"&gt;&lt;/i&gt; Sass
                                                </option>
                                                <option value="fas fa-save" <?php if($info['icon'] == 'fas fa-save'){ echo 'selected'; } ?> data-select2-id="select2-data-1071-l62o">
                                                    &lt;i class="fas fa-save"&gt;&lt;/i&gt; Save
                                                </option>
                                                <option value="fab fa-schlix" <?php if($info['icon'] == 'fab fa-schlix'){ echo 'selected'; } ?> data-select2-id="select2-data-1072-rsst">
                                                    &lt;i class="fab fa-schlix"&gt;&lt;/i&gt; SCHLIX
                                                </option>
                                                <option value="fas fa-school" <?php if($info['icon'] == 'fas fa-school'){ echo 'selected'; } ?> data-select2-id="select2-data-1073-50p0">
                                                    &lt;i class="fas fa-school"&gt;&lt;/i&gt; School
                                                </option>
                                                <option value="fas fa-screwdriver" <?php if($info['icon'] == 'fas fa-screwdriver'){ echo 'selected'; } ?> data-select2-id="select2-data-1074-a8ea">
                                                    &lt;i class="fas fa-screwdriver"&gt;&lt;/i&gt; Screwdriver
                                                </option>
                                                <option value="fab fa-scribd" <?php if($info['icon'] == 'fab fa-scribd'){ echo 'selected'; } ?> data-select2-id="select2-data-1075-zpqe">
                                                    &lt;i class="fab fa-scribd"&gt;&lt;/i&gt; Scribd
                                                </option>
                                                <option value="fas fa-search" <?php if($info['icon'] == 'fas fa-search'){ echo 'selected'; } ?> data-select2-id="select2-data-1078-53by">
                                                    &lt;i class="fas fa-search"&gt;&lt;/i&gt; Search
                                                </option>
                                                <option value="fas fa-search-minus" <?php if($info['icon'] == 'fas fa-search-minus'){ echo 'selected'; } ?> data-select2-id="select2-data-1081-74pt">
                                                    &lt;i class="fas fa-search-minus"&gt;&lt;/i&gt; Search Minus
                                                </option>
                                                <option value="fas fa-search-plus" <?php if($info['icon'] == 'fas fa-search-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-1082-um5g">
                                                    &lt;i class="fas fa-search-plus"&gt;&lt;/i&gt; Search Plus
                                                </option>
                                                <option value="fab fa-searchengin" <?php if($info['icon'] == 'fab fa-searchengin'){ echo 'selected'; } ?> data-select2-id="select2-data-1083-utxn">
                                                    &lt;i class="fab fa-searchengin"&gt;&lt;/i&gt; Searchengin
                                                </option>
                                                <option value="fas fa-seedling" <?php if($info['icon'] == 'fas fa-seedling'){ echo 'selected'; } ?> data-select2-id="select2-data-1084-zve3">
                                                    &lt;i class="fas fa-seedling"&gt;&lt;/i&gt; Seedling
                                                </option>
                                                <option value="fab fa-sellcast" <?php if($info['icon'] == 'fab fa-sellcast'){ echo 'selected'; } ?> data-select2-id="select2-data-1085-fgdx">
                                                    &lt;i class="fab fa-sellcast"&gt;&lt;/i&gt; Sellcast
                                                </option>
                                                <option value="fab fa-sellsy" <?php if($info['icon'] == 'fab fa-sellsy'){ echo 'selected'; } ?> data-select2-id="select2-data-1086-ypze">
                                                    &lt;i class="fab fa-sellsy"&gt;&lt;/i&gt; Sellsy
                                                </option>
                                                <option value="fas fa-server" <?php if($info['icon'] == 'fas fa-server'){ echo 'selected'; } ?> data-select2-id="select2-data-1087-ib9o">
                                                    &lt;i class="fas fa-server"&gt;&lt;/i&gt; Server
                                                </option>
                                                <option value="fab fa-servicestack" <?php if($info['icon'] == 'fab fa-servicestack'){ echo 'selected'; } ?> data-select2-id="select2-data-1088-m5xf">
                                                    &lt;i class="fab fa-servicestack"&gt;&lt;/i&gt; Servicestack
                                                </option>
                                                <option value="fas fa-share" <?php if($info['icon'] == 'fas fa-share'){ echo 'selected'; } ?> data-select2-id="select2-data-1090-3iak">
                                                    &lt;i class="fas fa-share"&gt;&lt;/i&gt; Share
                                                </option>
                                                <option value="fas fa-share-alt" <?php if($info['icon'] == 'fas fa-share-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1091-odnv">
                                                    &lt;i class="fas fa-share-alt"&gt;&lt;/i&gt; Alternate Share
                                                </option>
                                                <option value="fas fa-share-alt-square" <?php if($info['icon'] == 'fas fa-share-alt-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1092-ls0y">
                                                    &lt;i class="fas fa-share-alt-square"&gt;&lt;/i&gt; Alternate Share Square
                                                </option>
                                                <option value="fas fa-share-square" <?php if($info['icon'] == 'fas fa-share-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1093-32a8">
                                                    &lt;i class="fas fa-share-square"&gt;&lt;/i&gt; Share Square
                                                </option>
                                                <option value="fas fa-shekel-sign" <?php if($info['icon'] == 'fas fa-shekel-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1094-yyz4">
                                                    &lt;i class="fas fa-shekel-sign"&gt;&lt;/i&gt; Shekel Sign
                                                </option>
                                                <option value="fas fa-shield-alt" <?php if($info['icon'] == 'fas fa-shield-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1095-o41q">
                                                    &lt;i class="fas fa-shield-alt"&gt;&lt;/i&gt; Alternate Shield
                                                </option>
                                                <option value="fas fa-ship" <?php if($info['icon'] == 'fas fa-ship'){ echo 'selected'; } ?> data-select2-id="select2-data-1097-yw4r">
                                                    &lt;i class="fas fa-ship"&gt;&lt;/i&gt; Ship
                                                </option>
                                                <option value="fas fa-shipping-fast" <?php if($info['icon'] == 'fas fa-shipping-fast'){ echo 'selected'; } ?> data-select2-id="select2-data-1098-m44f">
                                                    &lt;i class="fas fa-shipping-fast"&gt;&lt;/i&gt; Shipping Fast
                                                </option>
                                                <option value="fab fa-shirtsinbulk" <?php if($info['icon'] == 'fab fa-shirtsinbulk'){ echo 'selected'; } ?> data-select2-id="select2-data-1099-vt1o">
                                                    &lt;i class="fab fa-shirtsinbulk"&gt;&lt;/i&gt; Shirts in Bulk
                                                </option>
                                                <option value="fas fa-shoe-prints" <?php if($info['icon'] == 'fas fa-shoe-prints'){ echo 'selected'; } ?> data-select2-id="select2-data-1100-soxf">
                                                    &lt;i class="fas fa-shoe-prints"&gt;&lt;/i&gt; Shoe Prints
                                                </option>
                                                <option value="fas fa-shopping-bag" <?php if($info['icon'] == 'fas fa-shopping-bag'){ echo 'selected'; } ?> data-select2-id="select2-data-1102-4nvi">
                                                    &lt;i class="fas fa-shopping-bag"&gt;&lt;/i&gt; Shopping Bag
                                                </option>
                                                <option value="fas fa-shopping-basket" <?php if($info['icon'] == 'fas fa-shopping-basket'){ echo 'selected'; } ?> data-select2-id="select2-data-1103-dzg9">
                                                    &lt;i class="fas fa-shopping-basket"&gt;&lt;/i&gt; Shopping Basket
                                                </option>
                                                <option value="fas fa-shopping-cart" <?php if($info['icon'] == 'fas fa-shopping-cart'){ echo 'selected'; } ?> data-select2-id="select2-data-1104-0cs6">
                                                    &lt;i class="fas fa-shopping-cart"&gt;&lt;/i&gt; shopping-cart
                                                </option>
                                                <option value="fas fa-shower" <?php if($info['icon'] == 'fas fa-shower'){ echo 'selected'; } ?> data-select2-id="select2-data-1106-b7a7">
                                                    &lt;i class="fas fa-shower"&gt;&lt;/i&gt; Shower
                                                </option>
                                                <option value="fas fa-sign" <?php if($info['icon'] == 'fas fa-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1108-w3n1">
                                                    &lt;i class="fas fa-sign"&gt;&lt;/i&gt; Sign
                                                </option>
                                                <option value="fas fa-sign-in-alt" <?php if($info['icon'] == 'fas fa-sign-in-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1109-7wvi">
                                                    &lt;i class="fas fa-sign-in-alt"&gt;&lt;/i&gt; Alternate Sign In
                                                </option>
                                                <option value="fas fa-sign-language" <?php if($info['icon'] == 'fas fa-sign-language'){ echo 'selected'; } ?> data-select2-id="select2-data-1110-k49n">
                                                    &lt;i class="fas fa-sign-language"&gt;&lt;/i&gt; Sign Language
                                                </option>
                                                <option value="fas fa-sign-out-alt" <?php if($info['icon'] == 'fas fa-sign-out-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1111-mf6u">
                                                    &lt;i class="fas fa-sign-out-alt"&gt;&lt;/i&gt; Alternate Sign Out
                                                </option>
                                                <option value="fas fa-signal" <?php if($info['icon'] == 'fas fa-signal'){ echo 'selected'; } ?> data-select2-id="select2-data-1112-qhl9">
                                                    &lt;i class="fas fa-signal"&gt;&lt;/i&gt; signal
                                                </option> 
                                                <option value="fab fa-simplybuilt" <?php if($info['icon'] == 'fab fa-simplybuilt'){ echo 'selected'; } ?> data-select2-id="select2-data-1115-v72m">
                                                    &lt;i class="fab fa-simplybuilt"&gt;&lt;/i&gt; SimplyBuilt
                                                </option>
                                                <option value="fab fa-sistrix" <?php if($info['icon'] == 'fab fa-sistrix'){ echo 'selected'; } ?> data-select2-id="select2-data-1117-ebh5">
                                                    &lt;i class="fab fa-sistrix"&gt;&lt;/i&gt; SISTRIX
                                                </option>
                                                <option value="fas fa-sitemap" <?php if($info['icon'] == 'fas fa-sitemap'){ echo 'selected'; } ?> data-select2-id="select2-data-1118-u50u">
                                                    &lt;i class="fas fa-sitemap"&gt;&lt;/i&gt; Sitemap
                                                </option>
                                                <option value="fab fa-sith" <?php if($info['icon'] == 'fab fa-sith'){ echo 'selected'; } ?> data-select2-id="select2-data-1119-qoer">
                                                    &lt;i class="fab fa-sith"&gt;&lt;/i&gt; Sith
                                                </option>
                                                <option value="fas fa-skull" <?php if($info['icon'] == 'fas fa-skull'){ echo 'selected'; } ?> data-select2-id="select2-data-1124-nwsf">
                                                    &lt;i class="fas fa-skull"&gt;&lt;/i&gt; Skull
                                                </option>
                                                <option value="fab fa-skyatlas" <?php if($info['icon'] == 'fab fa-skyatlas'){ echo 'selected'; } ?> data-select2-id="select2-data-1126-t7fj">
                                                    &lt;i class="fab fa-skyatlas"&gt;&lt;/i&gt; skyatlas
                                                </option>
                                                <option value="fab fa-skype" <?php if($info['icon'] == 'fab fa-skype'){ echo 'selected'; } ?> data-select2-id="select2-data-1127-46fx">
                                                    &lt;i class="fab fa-skype"&gt;&lt;/i&gt; Skype
                                                </option>
                                                <option value="fab fa-slack" <?php if($info['icon'] == 'fab fa-slack'){ echo 'selected'; } ?> data-select2-id="select2-data-1128-3sba">
                                                    &lt;i class="fab fa-slack"&gt;&lt;/i&gt; Slack Logo
                                                </option>
                                                <option value="fab fa-slack-hash" <?php if($info['icon'] == 'fab fa-slack-hash'){ echo 'selected'; } ?> data-select2-id="select2-data-1129-ek6e">
                                                    &lt;i class="fab fa-slack-hash"&gt;&lt;/i&gt; Slack Hashtag
                                                </option>
                                                <option value="fas fa-sliders-h" <?php if($info['icon'] == 'fas fa-sliders-h'){ echo 'selected'; } ?> data-select2-id="select2-data-1132-w03g">
                                                    &lt;i class="fas fa-sliders-h"&gt;&lt;/i&gt; Horizontal Sliders
                                                </option>
                                                <option value="fab fa-slideshare" <?php if($info['icon'] == 'fab fa-slideshare'){ echo 'selected'; } ?> data-select2-id="select2-data-1133-1eiv">
                                                    &lt;i class="fab fa-slideshare"&gt;&lt;/i&gt; Slideshare
                                                </option>
                                                <option value="fas fa-smile" <?php if($info['icon'] == 'fas fa-smile'){ echo 'selected'; } ?> data-select2-id="select2-data-1134-eaef">
                                                    &lt;i class="fas fa-smile"&gt;&lt;/i&gt; Smiling Face
                                                </option>
                                                <option value="fas fa-smoking" <?php if($info['icon'] == 'fas fa-smoking'){ echo 'selected'; } ?> data-select2-id="select2-data-1138-1c2n">
                                                    &lt;i class="fas fa-smoking"&gt;&lt;/i&gt; Smoking
                                                </option>
                                                <option value="fas fa-smoking-ban" <?php if($info['icon'] == 'fas fa-smoking-ban'){ echo 'selected'; } ?> data-select2-id="select2-data-1139-fyju">
                                                    &lt;i class="fas fa-smoking-ban"&gt;&lt;/i&gt; Smoking Ban
                                                </option>
                                                <option value="fab fa-snapchat" <?php if($info['icon'] == 'fab fa-snapchat'){ echo 'selected'; } ?> data-select2-id="select2-data-1141-llmp">
                                                    &lt;i class="fab fa-snapchat"&gt;&lt;/i&gt; Snapchat
                                                </option>
                                                <option value="fab fa-snapchat-ghost" <?php if($info['icon'] == 'fab fa-snapchat-ghost'){ echo 'selected'; } ?> data-select2-id="select2-data-1142-jk57">
                                                    &lt;i class="fab fa-snapchat-ghost"&gt;&lt;/i&gt; Snapchat Ghost
                                                </option>
                                                <option value="fab fa-snapchat-square" <?php if($info['icon'] == 'fab fa-snapchat-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1143-f2d3">
                                                    &lt;i class="fab fa-snapchat-square"&gt;&lt;/i&gt; Snapchat Square
                                                </option>
                                                <option value="fas fa-snowflake" <?php if($info['icon'] == 'fas fa-snowflake'){ echo 'selected'; } ?> data-select2-id="select2-data-1145-w333">
                                                    &lt;i class="fas fa-snowflake"&gt;&lt;/i&gt; Snowflake
                                                </option>
                                                <option value="fas fa-sort" <?php if($info['icon'] == 'fas fa-sort'){ echo 'selected'; } ?> data-select2-id="select2-data-1151-yxi4">
                                                    &lt;i class="fas fa-sort"&gt;&lt;/i&gt; Sort
                                                </option>
                                                <option value="fas fa-sort-alpha-down" <?php if($info['icon'] == 'fas fa-sort-alpha-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1152-hf4l">
                                                    &lt;i class="fas fa-sort-alpha-down"&gt;&lt;/i&gt; Sort Alphabetical Down
                                                </option>
                                                <option value="fas fa-sort-alpha-up" <?php if($info['icon'] == 'fas fa-sort-alpha-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1154-7qae">
                                                    &lt;i class="fas fa-sort-alpha-up"&gt;&lt;/i&gt; Sort Alphabetical Up
                                                </option>
                                                <option value="fas fa-sort-amount-down" <?php if($info['icon'] == 'fas fa-sort-amount-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1156-mbeh">
                                                    &lt;i class="fas fa-sort-amount-down"&gt;&lt;/i&gt; Sort Amount Down
                                                </option>
                                                <option value="fas fa-sort-amount-up" <?php if($info['icon'] == 'fas fa-sort-amount-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1158-v12i">
                                                    &lt;i class="fas fa-sort-amount-up"&gt;&lt;/i&gt; Sort Amount Up
                                                </option>
                                                <option value="fas fa-sort-amount-up-alt" <?php if($info['icon'] == 'fas fa-sort-amount-up-altfas fa-pills'){ echo 'selected'; } ?> data-select2-id="select2-data-1159-ums9">
                                                    &lt;i class="fas fa-sort-amount-up-alt"&gt;&lt;/i&gt; Alternate Sort Amount
                                                    Up
                                                </option>
                                                <option value="fas fa-sort-down" <?php if($info['icon'] == 'fas fa-sort-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1160-tu2m">
                                                    &lt;i class="fas fa-sort-down"&gt;&lt;/i&gt; Sort Down (Descending)
                                                </option>
                                                <option value="fas fa-sort-numeric-down" <?php if($info['icon'] == 'fas fa-sort-numeric-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1161-fttw">
                                                    &lt;i class="fas fa-sort-numeric-down"&gt;&lt;/i&gt; Sort Numeric Down
                                                </option>
                                                <option value="fas fa-sort-numeric-up" <?php if($info['icon'] == 'fas fa-sort-numeric-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1163-i9ux">
                                                    &lt;i class="fas fa-sort-numeric-up"&gt;&lt;/i&gt; Sort Numeric Up
                                                </option>
                                                <option value="fas fa-sort-up" <?php if($info['icon'] == 'fas fa-sort-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1165-00n8">
                                                    &lt;i class="fas fa-sort-up"&gt;&lt;/i&gt; Sort Up (Ascending)
                                                </option>
                                                <option value="fab fa-soundcloud" <?php if($info['icon'] == 'fab fa-soundcloud'){ echo 'selected'; } ?> data-select2-id="select2-data-1166-bs0v">
                                                    &lt;i class="fab fa-soundcloud"&gt;&lt;/i&gt; SoundCloud
                                                </option>
                                                <option value="fas fa-space-shuttle" <?php if($info['icon'] == 'fas fa-space-shuttle'){ echo 'selected'; } ?> data-select2-id="select2-data-1169-qaw0">
                                                    &lt;i class="fas fa-space-shuttle"&gt;&lt;/i&gt; Space Shuttle
                                                </option>
                                                <option value="fab fa-speakap" <?php if($info['icon'] == 'fab fa-speakap'){ echo 'selected'; } ?> data-select2-id="select2-data-1170-hp14">
                                                    &lt;i class="fab fa-speakap"&gt;&lt;/i&gt; Speakap
                                                </option>
                                                <option value="fas fa-spinner" <?php if($info['icon'] == 'fas fa-spinner'){ echo 'selected'; } ?> data-select2-id="select2-data-1174-ebxr">
                                                    &lt;i class="fas fa-spinner"&gt;&lt;/i&gt; Spinner
                                                </option>
                                                <option value="fab fa-spotify" <?php if($info['icon'] == 'fab fa-spotify'){ echo 'selected'; } ?> data-select2-id="select2-data-1176-ubz0">
                                                    &lt;i class="fab fa-spotify"&gt;&lt;/i&gt; Spotify
                                                </option>
                                                <option value="fas fa-square" <?php if($info['icon'] == 'fas fa-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1178-lyzp">
                                                    &lt;i class="fas fa-square"&gt;&lt;/i&gt; Square
                                                </option>
                                                <option value="fas fa-square-full" <?php if($info['icon'] == 'fas fa-square-full'){ echo 'selected'; } ?> data-select2-id="select2-data-1179-oeoc">
                                                    &lt;i class="fas fa-square-full"&gt;&lt;/i&gt; Square Full
                                                </option>
                                                <option value="fab fa-stack-exchange" <?php if($info['icon'] == 'fab fa-stack-exchange'){ echo 'selected'; } ?> data-select2-id="select2-data-1182-npx4">
                                                    &lt;i class="fab fa-stack-exchange"&gt;&lt;/i&gt; Stack Exchange
                                                </option>
                                                <option value="fab fa-stack-overflow" <?php if($info['icon'] == 'fab fa-stack-overflow'){ echo 'selected'; } ?> data-select2-id="select2-data-1183-lwx1">
                                                    &lt;i class="fab fa-stack-overflow"&gt;&lt;/i&gt; Stack Overflow
                                                </option>
                                                <option value="fas fa-star" <?php if($info['icon'] == 'fas fa-star'){ echo 'selected'; } ?> data-select2-id="select2-data-1186-u9d3">
                                                    &lt;i class="fas fa-star"&gt;&lt;/i&gt; Star
                                                </option>
                                                <option value="fas fa-star-half" <?php if($info['icon'] == 'fas fa-star-half'){ echo 'selected'; } ?> data-select2-id="select2-data-1188-kqxs">
                                                    &lt;i class="fas fa-star-half"&gt;&lt;/i&gt; star-half
                                                </option>
                                                <option value="fab fa-staylinked" <?php if($info['icon'] == 'fab fa-staylinked'){ echo 'selected'; } ?> data-select2-id="select2-data-1192-2ami">
                                                    &lt;i class="fab fa-staylinked"&gt;&lt;/i&gt; StayLinked
                                                </option>
                                                <option value="fab fa-steam" <?php if($info['icon'] == 'fab fa-steam'){ echo 'selected'; } ?> data-select2-id="select2-data-1193-5ggo">
                                                    &lt;i class="fab fa-steam"&gt;&lt;/i&gt; Steam
                                                </option>
                                                <option value="fab fa-steam-square" <?php if($info['icon'] == 'fab fa-steam-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1194-orkg">
                                                    &lt;i class="fab fa-steam-square"&gt;&lt;/i&gt; Steam Square
                                                </option>
                                                <option value="fab fa-steam-symbol" <?php if($info['icon'] == 'fab fa-steam-symbol'){ echo 'selected'; } ?> data-select2-id="select2-data-1195-xlnt">
                                                    &lt;i class="fab fa-steam-symbol"&gt;&lt;/i&gt; Steam Symbol
                                                </option>
                                                <option value="fas fa-step-backward" <?php if($info['icon'] == 'fas fa-step-backward'){ echo 'selected'; } ?> data-select2-id="select2-data-1196-id2r">
                                                    &lt;i class="fas fa-step-backward"&gt;&lt;/i&gt; step-backward
                                                </option>
                                                <option value="fas fa-step-forward" <?php if($info['icon'] == 'fas fa-step-forward'){ echo 'selected'; } ?> data-select2-id="select2-data-1197-66tk">
                                                    &lt;i class="fas fa-step-forward"&gt;&lt;/i&gt; step-forward
                                                </option>
                                                <option value="fas fa-stethoscope" <?php if($info['icon'] == 'fas fa-stethoscope'){ echo 'selected'; } ?> data-select2-id="select2-data-1198-2m0j">
                                                    &lt;i class="fas fa-stethoscope"&gt;&lt;/i&gt; Stethoscope
                                                </option>
                                                <option value="fab fa-sticker-mule" <?php if($info['icon'] == 'fab fa-sticker-mule'){ echo 'selected'; } ?> data-select2-id="select2-data-1199-kpam">
                                                    &lt;i class="fab fa-sticker-mule"&gt;&lt;/i&gt; Sticker Mule
                                                </option>
                                                <option value="fas fa-sticky-note" <?php if($info['icon'] == 'fas fa-sticky-note'){ echo 'selected'; } ?> data-select2-id="select2-data-1200-zhis">
                                                    &lt;i class="fas fa-sticky-note"&gt;&lt;/i&gt; Sticky Note
                                                </option>
                                                <option value="fas fa-stop" <?php if($info['icon'] == 'fas fa-stop'){ echo 'selected'; } ?> data-select2-id="select2-data-1201-0305">
                                                    &lt;i class="fas fa-stop"&gt;&lt;/i&gt; stop
                                                </option>
                                                <option value="fas fa-stop-circle" <?php if($info['icon'] == 'fas fa-stop-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-1202-jj36">
                                                    &lt;i class="fas fa-stop-circle"&gt;&lt;/i&gt; Stop Circle
                                                </option>
                                                <option value="fas fa-stopwatch" <?php if($info['icon'] == 'fas fa-stopwatch'){ echo 'selected'; } ?> data-select2-id="select2-data-1203-onrz">
                                                    &lt;i class="fas fa-stopwatch"&gt;&lt;/i&gt; Stopwatch
                                                </option>
                                                <option value="fas fa-store" <?php if($info['icon'] == 'fas fa-store'){ echo 'selected'; } ?> data-select2-id="select2-data-1205-590x">
                                                    &lt;i class="fas fa-store"&gt;&lt;/i&gt; Store
                                                </option>
                                                <option value="fas fa-store-alt" <?php if($info['icon'] == 'fas fa-store-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1206-rxr7">
                                                    &lt;i class="fas fa-store-alt"&gt;&lt;/i&gt; Alternate Store
                                                </option>
                                                <option value="fab fa-strava" <?php if($info['icon'] == 'fab fa-strava'){ echo 'selected'; } ?> data-select2-id="select2-data-1209-p3mc">
                                                    &lt;i class="fab fa-strava"&gt;&lt;/i&gt; Strava
                                                </option>
                                                <option value="fas fa-stream" <?php if($info['icon'] == 'fas fa-stream'){ echo 'selected'; } ?> data-select2-id="select2-data-1210-v4kh">
                                                    &lt;i class="fas fa-stream"&gt;&lt;/i&gt; Stream
                                                </option>
                                                <option value="fas fa-street-view" <?php if($info['icon'] == 'fas fa-street-view'){ echo 'selected'; } ?> data-select2-id="select2-data-1211-00gs">
                                                    &lt;i class="fas fa-street-view"&gt;&lt;/i&gt; Street View
                                                </option>
                                                <option value="fas fa-strikethrough" <?php if($info['icon'] == 'fas fa-strikethrough'){ echo 'selected'; } ?> data-select2-id="select2-data-1212-u420">
                                                    &lt;i class="fas fa-strikethrough"&gt;&lt;/i&gt; Strikethrough
                                                </option>
                                                <option value="fab fa-stripe" <?php if($info['icon'] == 'fab fa-stripe'){ echo 'selected'; } ?> data-select2-id="select2-data-1213-b39s">
                                                    &lt;i class="fab fa-stripe"&gt;&lt;/i&gt; Stripe
                                                </option>
                                                <option value="fab fa-stripe-s" <?php if($info['icon'] == 'fab fa-stripe-s'){ echo 'selected'; } ?> data-select2-id="select2-data-1214-nwx4">
                                                    &lt;i class="fab fa-stripe-s"&gt;&lt;/i&gt; Stripe S
                                                </option>
                                                <option value="fas fa-stroopwafel" <?php if($info['icon'] == 'fas fa-stroopwafel'){ echo 'selected'; } ?> data-select2-id="select2-data-1215-tu43">
                                                    &lt;i class="fas fa-stroopwafel"&gt;&lt;/i&gt; Stroopwafel
                                                </option>
                                                <option value="fab fa-studiovinari" <?php if($info['icon'] == 'fab fa-studiovinari'){ echo 'selected'; } ?> data-select2-id="select2-data-1216-b7b5">
                                                    &lt;i class="fab fa-studiovinari"&gt;&lt;/i&gt; Studio Vinari
                                                </option>
                                                <option value="fab fa-stumbleupon" <?php if($info['icon'] == 'fab fa-stumbleupon'){ echo 'selected'; } ?> data-select2-id="select2-data-1217-xre5">
                                                    &lt;i class="fab fa-stumbleupon"&gt;&lt;/i&gt; StumbleUpon Logo
                                                </option>
                                                <option value="fab fa-stumbleupon-circle" <?php if($info['icon'] == 'fab fa-stumbleupon-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-1218-5uq4">
                                                    &lt;i class="fab fa-stumbleupon-circle"&gt;&lt;/i&gt; StumbleUpon Circle
                                                </option>
                                                <option value="fas fa-subscript" <?php if($info['icon'] == 'fas fa-subscript'){ echo 'selected'; } ?> data-select2-id="select2-data-1219-x85q">
                                                    &lt;i class="fas fa-subscript"&gt;&lt;/i&gt; subscript
                                                </option>
                                                <option value="fas fa-subway" <?php if($info['icon'] == 'fas fa-subway'){ echo 'selected'; } ?> data-select2-id="select2-data-1220-4509">
                                                    &lt;i class="fas fa-subway"&gt;&lt;/i&gt; Subway
                                                </option>
                                                <option value="fas fa-suitcase" <?php if($info['icon'] == 'fas fa-suitcase'){ echo 'selected'; } ?> data-select2-id="select2-data-1221-k4v3">
                                                    &lt;i class="fas fa-suitcase"&gt;&lt;/i&gt; Suitcase
                                                </option>
                                                <option value="fas fa-sun" <?php if($info['icon'] == 'fas fa-sun'){ echo 'selected'; } ?> data-select2-id="select2-data-1223-ksd8">
                                                    &lt;i class="fas fa-sun"&gt;&lt;/i&gt; Sun
                                                </option>
                                                <option value="fab fa-superpowers" <?php if($info['icon'] == 'fab fa-superpowers'){ echo 'selected'; } ?> data-select2-id="select2-data-1224-xr4g">
                                                    &lt;i class="fab fa-superpowers"&gt;&lt;/i&gt; Superpowers
                                                </option>
                                                <option value="fas fa-superscript" <?php if($info['icon'] == 'fas fa-superscript'){ echo 'selected'; } ?> data-select2-id="select2-data-1225-ag2h">
                                                    &lt;i class="fas fa-superscript"&gt;&lt;/i&gt; superscript
                                                </option>
                                                <option value="fab fa-supple" <?php if($info['icon'] == 'fab fa-supple'){ echo 'selected'; } ?> data-select2-id="select2-data-1226-kkbx">
                                                    &lt;i class="fab fa-supple"&gt;&lt;/i&gt; Supple
                                                </option>
                                                <option value="fas fa-sync" <?php if($info['icon'] == 'fas fa-sync'){ echo 'selected'; } ?> data-select2-id="select2-data-1235-umhy">
                                                    &lt;i class="fas fa-sync"&gt;&lt;/i&gt; Sync
                                                </option>
                                                <option value="fas fa-sync-alt" <?php if($info['icon'] == 'fas fa-sync-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1236-ppcl">
                                                    &lt;i class="fas fa-sync-alt"&gt;&lt;/i&gt; Alternate Sync
                                                </option>
                                                <option value="fas fa-syringe" <?php if($info['icon'] == 'fas fa-syringe'){ echo 'selected'; } ?> data-select2-id="select2-data-1237-a0dz">
                                                    &lt;i class="fas fa-syringe"&gt;&lt;/i&gt; Syringe
                                                </option>
                                                <option value="fas fa-table" <?php if($info['icon'] == 'fas fa-table'){ echo 'selected'; } ?> data-select2-id="select2-data-1238-8zss">
                                                    &lt;i class="fas fa-table"&gt;&lt;/i&gt; table
                                                </option>
                                                <option value="fas fa-table-tennis" <?php if($info['icon'] == 'fas fa-table-tennis'){ echo 'selected'; } ?> data-select2-id="select2-data-1239-sjc7">
                                                    &lt;i class="fas fa-table-tennis"&gt;&lt;/i&gt; Table Tennis
                                                </option>
                                                <option value="fas fa-tablet" <?php if($info['icon'] == 'fas fa-tablet'){ echo 'selected'; } ?> data-select2-id="select2-data-1240-gm6p">
                                                    &lt;i class="fas fa-tablet"&gt;&lt;/i&gt; tablet
                                                </option>
                                                <option value="fas fa-tablet-alt" <?php if($info['icon'] == 'fas fa-tablet-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1241-av5p">
                                                    &lt;i class="fas fa-tablet-alt"&gt;&lt;/i&gt; Alternate Tablet
                                                </option>
                                                <option value="fas fa-tablets" <?php if($info['icon'] == 'fas fa-tablets'){ echo 'selected'; } ?> data-select2-id="select2-data-1242-d3u2">
                                                    &lt;i class="fas fa-tablets"&gt;&lt;/i&gt; Tablets
                                                </option>
                                                <option value="fas fa-tachometer-alt" <?php if($info['icon'] == 'fas fa-tachometer-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1243-wuuw">
                                                    &lt;i class="fas fa-tachometer-alt"&gt;&lt;/i&gt; Alternate Tachometer
                                                </option>
                                                <option value="fas fa-tag" <?php if($info['icon'] == 'fas fa-tag'){ echo 'selected'; } ?> data-select2-id="select2-data-1244-eidm">
                                                    &lt;i class="fas fa-tag"&gt;&lt;/i&gt; tag
                                                </option>
                                                <option value="fas fa-tags" <?php if($info['icon'] == 'fas fa-tags'){ echo 'selected'; } ?> data-select2-id="select2-data-1245-bdpu">
                                                    &lt;i class="fas fa-tags"&gt;&lt;/i&gt; tags
                                                </option>
                                                <option value="fas fa-tape" <?php if($info['icon'] == 'fas fa-tape'){ echo 'selected'; } ?> data-select2-id="select2-data-1246-f39c">
                                                    &lt;i class="fas fa-tape"&gt;&lt;/i&gt; Tape
                                                </option>
                                                <option value="fas fa-tasks" <?php if($info['icon'] == 'fas fa-tasks'){ echo 'selected'; } ?> data-select2-id="select2-data-1247-nldr">
                                                    &lt;i class="fas fa-tasks"&gt;&lt;/i&gt; Tasks
                                                </option>
                                                <option value="fas fa-taxi" <?php if($info['icon'] == 'fas fa-taxi'){ echo 'selected'; } ?> data-select2-id="select2-data-1248-yph3">
                                                    &lt;i class="fas fa-taxi"&gt;&lt;/i&gt; Taxi
                                                </option>
                                                <option value="fab fa-teamspeak" <?php if($info['icon'] == 'fab fa-teamspeak'){ echo 'selected'; } ?> data-select2-id="select2-data-1249-61mt">
                                                    &lt;i class="fab fa-teamspeak"&gt;&lt;/i&gt; TeamSpeak
                                                </option>
                                                <option value="fab fa-telegram" <?php if($info['icon'] == 'fab fa-telegram'){ echo 'selected'; } ?> data-select2-id="select2-data-1252-15i7">
                                                    &lt;i class="fab fa-telegram"&gt;&lt;/i&gt; Telegram
                                                </option>
                                                <option value="fab fa-telegram-plane" <?php if($info['icon'] == 'fab fa-telegram-plane'){ echo 'selected'; } ?> data-select2-id="select2-data-1253-n36d">
                                                    &lt;i class="fab fa-telegram-plane"&gt;&lt;/i&gt; Telegram Plane
                                                </option>
                                                <option value="fab fa-tencent-weibo" <?php if($info['icon'] == 'fab fa-tencent-weibo'){ echo 'selected'; } ?> data-select2-id="select2-data-1256-xpbt">
                                                    &lt;i class="fab fa-tencent-weibo"&gt;&lt;/i&gt; Tencent Weibo
                                                </option>
                                                <option value="fas fa-terminal" <?php if($info['icon'] == 'fas fa-terminal'){ echo 'selected'; } ?> data-select2-id="select2-data-1258-2qdd">
                                                    &lt;i class="fas fa-terminal"&gt;&lt;/i&gt; Terminal
                                                </option>
                                                <option value="fas fa-text-height" <?php if($info['icon'] == 'fas fa-text-height'){ echo 'selected'; } ?> data-select2-id="select2-data-1259-iaxz">
                                                    &lt;i class="fas fa-text-height"&gt;&lt;/i&gt; text-height
                                                </option>
                                                <option value="fas fa-text-width" <?php if($info['icon'] == 'fas fa-text-width'){ echo 'selected'; } ?> data-select2-id="select2-data-1260-d5bu">
                                                    &lt;i class="fas fa-text-width"&gt;&lt;/i&gt; Text Width
                                                </option>
                                                <option value="fas fa-th" <?php if($info['icon'] == 'fas fa-th'){ echo 'selected'; } ?> data-select2-id="select2-data-1261-j8py">
                                                    &lt;i class="fas fa-th"&gt;&lt;/i&gt; th
                                                </option>
                                                <option value="fas fa-th-large" <?php if($info['icon'] == 'fas fa-th-large'){ echo 'selected'; } ?> data-select2-id="select2-data-1262-s2ni">
                                                    &lt;i class="fas fa-th-large"&gt;&lt;/i&gt; th-large
                                                </option>
                                                <option value="fas fa-th-list" <?php if($info['icon'] == 'fas fa-th-list'){ echo 'selected'; } ?> data-select2-id="select2-data-1263-ni53">
                                                    &lt;i class="fas fa-th-list"&gt;&lt;/i&gt; th-list
                                                </option>
                                                <option value="fab fa-themeisle" <?php if($info['icon'] == 'fab fa-themeisle'){ echo 'selected'; } ?> data-select2-id="select2-data-1267-6af3">
                                                    &lt;i class="fab fa-themeisle"&gt;&lt;/i&gt; ThemeIsle
                                                </option>
                                                <option value="fas fa-thermometer" <?php if($info['icon'] == 'fas fa-thermometer'){ echo 'selected'; } ?> data-select2-id="select2-data-1268-vr8q">
                                                    &lt;i class="fas fa-thermometer"&gt;&lt;/i&gt; Thermometer
                                                </option>
                                                <option value="fas fa-thermometer-empty" <?php if($info['icon'] == 'fas fa-thermometer-empty'){ echo 'selected'; } ?> data-select2-id="select2-data-1269-giu3">
                                                    &lt;i class="fas fa-thermometer-empty"&gt;&lt;/i&gt; Thermometer Empty
                                                </option>
                                                <option value="fas fa-thermometer-full" <?php if($info['icon'] == 'fas fa-thermometer-full'){ echo 'selected'; } ?> data-select2-id="select2-data-1270-cu7d">
                                                    &lt;i class="fas fa-thermometer-full"&gt;&lt;/i&gt; Thermometer Full
                                                </option>
                                                <option value="fas fa-thermometer-half" <?php if($info['icon'] == 'fas fa-thermometer-half'){ echo 'selected'; } ?> data-select2-id="select2-data-1271-2f9o">
                                                    &lt;i class="fas fa-thermometer-half"&gt;&lt;/i&gt; Thermometer 1/2 Full
                                                </option>
                                                <option value="fas fa-thermometer-quarter" <?php if($info['icon'] == 'fas fa-thermometer-quarter'){ echo 'selected'; } ?> data-select2-id="select2-data-1272-ytb5">
                                                    &lt;i class="fas fa-thermometer-quarter"&gt;&lt;/i&gt; Thermometer 1/4 Full
                                                </option>
                                                <option value="fas fa-thermometer-three-quarters" <?php if($info['icon'] == 'fas fa-thermometer-three-quarters'){ echo 'selected'; } ?> data-select2-id="select2-data-1273-mjf5">
                                                    &lt;i class="fas fa-thermometer-three-quarters"&gt;&lt;/i&gt; Thermometer
                                                    3/4 Full
                                                </option>
                                                <option value="fas fa-thumbs-down" <?php if($info['icon'] == 'fas fa-thumbs-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1275-2elm">
                                                    &lt;i class="fas fa-thumbs-down"&gt;&lt;/i&gt; thumbs-down
                                                </option>
                                                <option value="fas fa-thumbs-up" <?php if($info['icon'] == 'fas fa-thumbs-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1276-9oo6">
                                                    &lt;i class="fas fa-thumbs-up"&gt;&lt;/i&gt; thumbs-up
                                                </option>
                                                <option value="fas fa-thumbtack" <?php if($info['icon'] == 'fas fa-thumbtack'){ echo 'selected'; } ?> data-select2-id="select2-data-1277-iqmy">
                                                    &lt;i class="fas fa-thumbtack"&gt;&lt;/i&gt; Thumbtack
                                                </option>
                                                <option value="fas fa-ticket-alt" <?php if($info['icon'] == 'fas fa-ticket-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1278-vo36">
                                                    &lt;i class="fas fa-ticket-alt"&gt;&lt;/i&gt; Alternate Ticket
                                                </option>
                                                <option value="fas fa-times" <?php if($info['icon'] == 'fas fa-times'){ echo 'selected'; } ?> data-select2-id="select2-data-1280-8dt5">
                                                    &lt;i class="fas fa-times"&gt;&lt;/i&gt; Times
                                                </option>
                                                <option value="fas fa-times-circle" <?php if($info['icon'] == 'fas fa-times-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-1281-xqnt">
                                                    &lt;i class="fas fa-times-circle"&gt;&lt;/i&gt; Times Circle
                                                </option>
                                                <option value="fas fa-tint" <?php if($info['icon'] == 'fas fa-tint'){ echo 'selected'; } ?> data-select2-id="select2-data-1282-lloq">
                                                    &lt;i class="fas fa-tint"&gt;&lt;/i&gt; tint
                                                </option>
                                                <option value="fas fa-toggle-off" <?php if($info['icon'] == 'fas fa-toggle-off'){ echo 'selected'; } ?> data-select2-id="select2-data-1285-cvfg">
                                                    &lt;i class="fas fa-toggle-off"&gt;&lt;/i&gt; Toggle Off
                                                </option>
                                                <option value="fas fa-toggle-on" <?php if($info['icon'] == 'fas fa-toggle-on'){ echo 'selected'; } ?> data-select2-id="select2-data-1286-oc3h">
                                                    &lt;i class="fas fa-toggle-on"&gt;&lt;/i&gt; Toggle On
                                                </option>
                                                <option value="fas fa-toolbox" <?php if($info['icon'] == 'fas fa-toolbox'){ echo 'selected'; } ?> data-select2-id="select2-data-1290-otpd">
                                                    &lt;i class="fas fa-toolbox"&gt;&lt;/i&gt; Toolbox
                                                </option>
                                                <option value="fab fa-trade-federation" <?php if($info['icon'] == 'fab fa-trade-federation'){ echo 'selected'; } ?> data-select2-id="select2-data-1296-eo07">
                                                    &lt;i class="fab fa-trade-federation"&gt;&lt;/i&gt; Trade Federation
                                                </option>
                                                <option value="fas fa-trademark" <?php if($info['icon'] == 'fas fa-trademark'){ echo 'selected'; } ?> data-select2-id="select2-data-1297-kbzq">
                                                    &lt;i class="fas fa-trademark"&gt;&lt;/i&gt; Trademark
                                                </option>
                                                <option value="fas fa-train" <?php if($info['icon'] == 'fas fa-train'){ echo 'selected'; } ?> data-select2-id="select2-data-1300-0x3c">
                                                    &lt;i class="fas fa-train"&gt;&lt;/i&gt; Train
                                                </option>
                                                <option value="fas fa-transgender" <?php if($info['icon'] == 'fas fa-transgender'){ echo 'selected'; } ?> data-select2-id="select2-data-1302-2xux">
                                                    &lt;i class="fas fa-transgender"&gt;&lt;/i&gt; Transgender
                                                </option>
                                                <option value="fas fa-transgender-alt" <?php if($info['icon'] == 'fas fa-transgender-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1303-sinj">
                                                    &lt;i class="fas fa-transgender-alt"&gt;&lt;/i&gt; Alternate Transgender
                                                </option>
                                                <option value="fas fa-trash" <?php if($info['icon'] == 'fas fa-trash'){ echo 'selected'; } ?> data-select2-id="select2-data-1304-aln6">
                                                    &lt;i class="fas fa-trash"&gt;&lt;/i&gt; Trash
                                                </option>
                                                <option value="fas fa-trash-alt" <?php if($info['icon'] == 'fas fa-trash-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1305-ovyk">
                                                    &lt;i class="fas fa-trash-alt"&gt;&lt;/i&gt; Alternate Trash
                                                </option>
                                                <option value="fas fa-tree" <?php if($info['icon'] == 'fas fa-tree'){ echo 'selected'; } ?> data-select2-id="select2-data-1308-s4np">
                                                    &lt;i class="fas fa-tree"&gt;&lt;/i&gt; Tree
                                                </option>
                                                <option value="fab fa-trello" <?php if($info['icon'] == 'fab fa-trello'){ echo 'selected'; } ?> data-select2-id="select2-data-1309-53jo">
                                                    &lt;i class="fab fa-trello"&gt;&lt;/i&gt; Trello
                                                </option>
                                                <option value="fab fa-tripadvisor" <?php if($info['icon'] == 'fab fa-tripadvisor'){ echo 'selected'; } ?> data-select2-id="select2-data-1310-2tgy">
                                                    &lt;i class="fab fa-tripadvisor"&gt;&lt;/i&gt; TripAdvisor
                                                </option>
                                                <option value="fas fa-trophy" <?php if($info['icon'] == 'fas fa-trophy'){ echo 'selected'; } ?> data-select2-id="select2-data-1311-3obm">
                                                    &lt;i class="fas fa-trophy"&gt;&lt;/i&gt; trophy
                                                </option>
                                                <option value="fas fa-truck" <?php if($info['icon'] == 'fas fa-truck'){ echo 'selected'; } ?> data-select2-id="select2-data-1312-5ikb">
                                                    &lt;i class="fas fa-truck"&gt;&lt;/i&gt; truck
                                                </option>
                                                <option value="fas fa-truck-loading" <?php if($info['icon'] == 'fas fa-truck-loading'){ echo 'selected'; } ?> data-select2-id="select2-data-1313-tws8">
                                                    &lt;i class="fas fa-truck-loading"&gt;&lt;/i&gt; Truck Loading
                                                </option>
                                                <option value="fas fa-truck-moving" <?php if($info['icon'] == 'fas fa-truck-moving'){ echo 'selected'; } ?> data-select2-id="select2-data-1315-dp1p">
                                                    &lt;i class="fas fa-truck-moving"&gt;&lt;/i&gt; Truck Moving
                                                </option>
                                                <option value="fas fa-tshirt" <?php if($info['icon'] == 'fas fa-tshirt'){ echo 'selected'; } ?> data-select2-id="select2-data-1317-k4ha">
                                                    &lt;i class="fas fa-tshirt"&gt;&lt;/i&gt; T-Shirt
                                                </option>
                                                <option value="fas fa-tty" <?php if($info['icon'] == 'fas fa-tty'){ echo 'selected'; } ?> data-select2-id="select2-data-1318-8x7k">
                                                    &lt;i class="fas fa-tty"&gt;&lt;/i&gt; TTY
                                                </option>
                                                <option value="fab fa-tumblr" <?php if($info['icon'] == 'fab fa-tumblr'){ echo 'selected'; } ?> data-select2-id="select2-data-1319-8gq3">
                                                    &lt;i class="fab fa-tumblr"&gt;&lt;/i&gt; Tumblr
                                                </option>
                                                <option value="fab fa-tumblr-square" <?php if($info['icon'] == 'fab fa-tumblr-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1320-01tx">
                                                    &lt;i class="fab fa-tumblr-square"&gt;&lt;/i&gt; Tumblr Square
                                                </option>
                                                <option value="fas fa-tv" <?php if($info['icon'] == 'fas fa-tv'){ echo 'selected'; } ?> data-select2-id="select2-data-1321-vbo7">
                                                    &lt;i class="fas fa-tv"&gt;&lt;/i&gt; Television
                                                </option>
                                                <option value="fab fa-twitch" <?php if($info['icon'] == 'fab fa-twitch'){ echo 'selected'; } ?> data-select2-id="select2-data-1322-6yx2">
                                                    &lt;i class="fab fa-twitch"&gt;&lt;/i&gt; Twitch
                                                </option>
                                                <option value="fab fa-twitter" <?php if($info['icon'] == 'fab fa-twitter'){ echo 'selected'; } ?> data-select2-id="select2-data-1323-aar1">
                                                    &lt;i class="fab fa-twitter"&gt;&lt;/i&gt; Twitter
                                                </option>
                                                <option value="fab fa-twitter-square" <?php if($info['icon'] == 'fab fa-twitter-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1324-3vux">
                                                    &lt;i class="fab fa-twitter-square"&gt;&lt;/i&gt; Twitter Square
                                                </option>
                                                <option value="fab fa-typo3" <?php if($info['icon'] == 'fab fa-typo3'){ echo 'selected'; } ?> data-select2-id="select2-data-1325-b19t">
                                                    &lt;i class="fab fa-typo3"&gt;&lt;/i&gt; Typo3
                                                </option>
                                                <option value="fab fa-uber" <?php if($info['icon'] == 'fab fa-uber'){ echo 'selected'; } ?> data-select2-id="select2-data-1326-a7gw">
                                                    &lt;i class="fab fa-uber"&gt;&lt;/i&gt; Uber
                                                </option>
                                                <option value="fab fa-uikit" <?php if($info['icon'] == 'fab fa-uikit'){ echo 'selected'; } ?> data-select2-id="select2-data-1328-pv4e">
                                                    &lt;i class="fab fa-uikit"&gt;&lt;/i&gt; UIkit
                                                </option>
                                                <option value="fas fa-umbrella" <?php if($info['icon'] == 'fas fa-umbrella'){ echo 'selected'; } ?> data-select2-id="select2-data-1330-wd7u">
                                                    &lt;i class="fas fa-umbrella"&gt;&lt;/i&gt; Umbrella
                                                </option>
                                                <option value="fas fa-underline" <?php if($info['icon'] == 'fas fa-underline'){ echo 'selected'; } ?> data-select2-id="select2-data-1333-hfdn">
                                                    &lt;i class="fas fa-underline"&gt;&lt;/i&gt; Underline
                                                </option>
                                                <option value="fas fa-undo" <?php if($info['icon'] == 'fas fa-undo'){ echo 'selected'; } ?> data-select2-id="select2-data-1334-j3hb">
                                                    &lt;i class="fas fa-undo"&gt;&lt;/i&gt; Undo
                                                </option>
                                                <option value="fas fa-undo-alt" <?php if($info['icon'] == 'fas fa-undo-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1335-uc47">
                                                    &lt;i class="fas fa-undo-alt"&gt;&lt;/i&gt; Alternate Undo
                                                </option>
                                                <option value="fab fa-uniregistry" <?php if($info['icon'] == 'fab fa-uniregistry'){ echo 'selected'; } ?> data-select2-id="select2-data-1336-nqqj">
                                                    &lt;i class="fab fa-uniregistry"&gt;&lt;/i&gt; Uniregistry
                                                </option>
                                                <option value="fas fa-universal-access" <?php if($info['icon'] == 'fas fa-universal-access'){ echo 'selected'; } ?> data-select2-id="select2-data-1338-byh5">
                                                    &lt;i class="fas fa-universal-access"&gt;&lt;/i&gt; Universal Access
                                                </option>
                                                <option value="fas fa-university" <?php if($info['icon'] == 'fas fa-university'){ echo 'selected'; } ?> data-select2-id="select2-data-1339-zdfq">
                                                    &lt;i class="fas fa-university"&gt;&lt;/i&gt; University
                                                </option>
                                                <option value="fas fa-unlink" <?php if($info['icon'] == 'fas fa-unlink'){ echo 'selected'; } ?> data-select2-id="select2-data-1340-ts53">
                                                    &lt;i class="fas fa-unlink"&gt;&lt;/i&gt; unlink
                                                </option>
                                                <option value="fas fa-unlock" <?php if($info['icon'] == 'fas fa-unlock'){ echo 'selected'; } ?> data-select2-id="select2-data-1341-zcat">
                                                    &lt;i class="fas fa-unlock"&gt;&lt;/i&gt; unlock
                                                </option>
                                                <option value="fas fa-unlock-alt" <?php if($info['icon'] == 'fas fa-unlock-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1342-d1zg">
                                                    &lt;i class="fas fa-unlock-alt"&gt;&lt;/i&gt; Alternate Unlock
                                                </option>
                                                <option value="fab fa-untappd" <?php if($info['icon'] == 'fab fa-untappd'){ echo 'selected'; } ?> data-select2-id="select2-data-1344-kngs">
                                                    &lt;i class="fab fa-untappd"&gt;&lt;/i&gt; Untappd
                                                </option>
                                                <option value="fas fa-upload" <?php if($info['icon'] == 'fas fa-upload'){ echo 'selected'; } ?> data-select2-id="select2-data-1345-xzh6">
                                                    &lt;i class="fas fa-upload"&gt;&lt;/i&gt; Upload
                                                </option>
                                                <option value="fab fa-usb" <?php if($info['icon'] == 'fab fa-usb'){ echo 'selected'; } ?> data-select2-id="select2-data-1347-z9ph">
                                                    &lt;i class="fab fa-usb"&gt;&lt;/i&gt; USB
                                                </option>
                                                <option value="fas fa-user" <?php if($info['icon'] == 'fas fa-user'){ echo 'selected'; } ?> data-select2-id="select2-data-1348-ourk">
                                                    &lt;i class="fas fa-user"&gt;&lt;/i&gt; User
                                                </option>
                                                <option value="fas fa-user-alt" <?php if($info['icon'] == 'fas fa-user-alt'){ echo 'selected'; } ?> data-select2-id="select2-data-1349-58ga">
                                                    &lt;i class="fas fa-user-alt"&gt;&lt;/i&gt; Alternate User
                                                </option>
                                                <option value="fas fa-user-alt-slash" <?php if($info['icon'] == 'fas fa-user-alt-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-1350-5yrz">
                                                    &lt;i class="fas fa-user-alt-slash"&gt;&lt;/i&gt; Alternate User Slash
                                                </option>
                                                <option value="fas fa-user-astronaut" <?php if($info['icon'] == 'fas fa-user-astronaut'){ echo 'selected'; } ?> data-select2-id="select2-data-1351-uhwk">
                                                    &lt;i class="fas fa-user-astronaut"&gt;&lt;/i&gt; User Astronaut
                                                </option>
                                                <option value="fas fa-user-check" <?php if($info['icon'] == 'fas fa-user-check'){ echo 'selected'; } ?> data-select2-id="select2-data-1352-wllw">
                                                    &lt;i class="fas fa-user-check"&gt;&lt;/i&gt; User Check
                                                </option>
                                                <option value="fas fa-user-circle" <?php if($info['icon'] == 'fas fa-user-circle'){ echo 'selected'; } ?> data-select2-id="select2-data-1353-idb1">
                                                    &lt;i class="fas fa-user-circle"&gt;&lt;/i&gt; User Circle
                                                </option>
                                                <option value="fas fa-user-clock" <?php if($info['icon'] == 'fas fa-user-clock'){ echo 'selected'; } ?> data-select2-id="select2-data-1354-l729">
                                                    &lt;i class="fas fa-user-clock"&gt;&lt;/i&gt; User Clock
                                                </option>
                                                <option value="fas fa-user-cog" <?php if($info['icon'] == 'fas fa-user-cog'){ echo 'selected'; } ?> data-select2-id="select2-data-1355-i2q2">
                                                    &lt;i class="fas fa-user-cog"&gt;&lt;/i&gt; User Cog
                                                </option>
                                                <option value="fas fa-user-edit" <?php if($info['icon'] == 'fas fa-user-edit'){ echo 'selected'; } ?> data-select2-id="select2-data-1356-gapg">
                                                    &lt;i class="fas fa-user-edit"&gt;&lt;/i&gt; User Edit
                                                </option>
                                                <option value="fas fa-user-friends" <?php if($info['icon'] == 'fas fa-user-friends'){ echo 'selected'; } ?> data-select2-id="select2-data-1357-hm9k">
                                                    &lt;i class="fas fa-user-friends"&gt;&lt;/i&gt; User Friends
                                                </option>
                                                <option value="fas fa-user-graduate" <?php if($info['icon'] == 'fas fa-user-graduate'){ echo 'selected'; } ?> data-select2-id="select2-data-1358-9vk6">
                                                    &lt;i class="fas fa-user-graduate"&gt;&lt;/i&gt; User Graduate
                                                </option>
                                                <option value="fas fa-user-lock" <?php if($info['icon'] == 'fas fa-user-lock'){ echo 'selected'; } ?> data-select2-id="select2-data-1360-66qk">
                                                    &lt;i class="fas fa-user-lock"&gt;&lt;/i&gt; User Lock
                                                </option>
                                                <option value="fas fa-user-md" <?php if($info['icon'] == 'fas fa-user-md'){ echo 'selected'; } ?> data-select2-id="select2-data-1361-honb">
                                                    &lt;i class="fas fa-user-md"&gt;&lt;/i&gt; Doctor
                                                </option>
                                                <option value="fas fa-user-minus" <?php if($info['icon'] == 'fas fa-user-minus'){ echo 'selected'; } ?> data-select2-id="select2-data-1362-ao1l">
                                                    &lt;i class="fas fa-user-minus"&gt;&lt;/i&gt; User Minus
                                                </option>
                                                <option value="fas fa-user-ninja" <?php if($info['icon'] == 'fas fa-user-ninja'){ echo 'selected'; } ?> data-select2-id="select2-data-1363-g2xh">
                                                    &lt;i class="fas fa-user-ninja"&gt;&lt;/i&gt; User Ninja
                                                </option>
                                                <option value="fas fa-user-plus" <?php if($info['icon'] == 'fas fa-user-plus'){ echo 'selected'; } ?> data-select2-id="select2-data-1365-ace9">
                                                    &lt;i class="fas fa-user-plus"&gt;&lt;/i&gt; User Plus
                                                </option>
                                                <option value="fas fa-user-secret" <?php if($info['icon'] == 'fas fa-user-secret'){ echo 'selected'; } ?> data-select2-id="select2-data-1366-25wg">
                                                    &lt;i class="fas fa-user-secret"&gt;&lt;/i&gt; User Secret
                                                </option>
                                                <option value="fas fa-user-shield" <?php if($info['icon'] == 'fas fa-user-shield'){ echo 'selected'; } ?> data-select2-id="select2-data-1367-58r7">
                                                    &lt;i class="fas fa-user-shield"&gt;&lt;/i&gt; User Shield
                                                </option>
                                                <option value="fas fa-user-slash" <?php if($info['icon'] == 'fas fa-user-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-1368-3a6e">
                                                    &lt;i class="fas fa-user-slash"&gt;&lt;/i&gt; User Slash
                                                </option>
                                                <option value="fas fa-user-tag" <?php if($info['icon'] == 'fas fa-user-tag'){ echo 'selected'; } ?> data-select2-id="select2-data-1369-cd7h">
                                                    &lt;i class="fas fa-user-tag"&gt;&lt;/i&gt; User Tag
                                                </option>
                                                <option value="fas fa-user-tie" <?php if($info['icon'] == 'fas fa-user-tie'){ echo 'selected'; } ?> data-select2-id="select2-data-1370-cnsz">
                                                    &lt;i class="fas fa-user-tie"&gt;&lt;/i&gt; User Tie
                                                </option>
                                                <option value="fas fa-user-times" <?php if($info['icon'] == 'fas fa-user-times'){ echo 'selected'; } ?> data-select2-id="select2-data-1371-9s5u">
                                                    &lt;i class="fas fa-user-times"&gt;&lt;/i&gt; Remove User
                                                </option>
                                                <option value="fas fa-users" <?php if($info['icon'] == 'fas fa-users'){ echo 'selected'; } ?> data-select2-id="select2-data-1372-mzcm">
                                                    &lt;i class="fas fa-users"&gt;&lt;/i&gt; Users
                                                </option>
                                                <option value="fas fa-users-cog" <?php if($info['icon'] == 'fas fa-users-cog'){ echo 'selected'; } ?> data-select2-id="select2-data-1373-0ydj">
                                                    &lt;i class="fas fa-users-cog"&gt;&lt;/i&gt; Users Cog
                                                </option>
                                                <option value="fab fa-ussunnah" <?php if($info['icon'] == 'fab fa-ussunnah'){ echo 'selected'; } ?> data-select2-id="select2-data-1376-6481">
                                                    &lt;i class="fab fa-ussunnah"&gt;&lt;/i&gt; us-Sunnah Foundation
                                                </option>
                                                <option value="fas fa-utensil-spoon" <?php if($info['icon'] == 'fas fa-utensil-spoon'){ echo 'selected'; } ?> data-select2-id="select2-data-1377-t3ob">
                                                    &lt;i class="fas fa-utensil-spoon"&gt;&lt;/i&gt; Utensil Spoon
                                                </option>
                                                <option value="fas fa-utensils" <?php if($info['icon'] == 'fas fa-utensils'){ echo 'selected'; } ?> data-select2-id="select2-data-1378-1dw0">
                                                    &lt;i class="fas fa-utensils"&gt;&lt;/i&gt; Utensils
                                                </option>
                                                <option value="fab fa-vaadin" <?php if($info['icon'] == 'fab fa-vaadin'){ echo 'selected'; } ?> data-select2-id="select2-data-1379-6r1b">
                                                    &lt;i class="fab fa-vaadin"&gt;&lt;/i&gt; Vaadin
                                                </option>
                                                <option value="fas fa-venus" <?php if($info['icon'] == 'fas fa-venus'){ echo 'selected'; } ?> data-select2-id="select2-data-1381-qq4h">
                                                    &lt;i class="fas fa-venus"&gt;&lt;/i&gt; Venus
                                                </option>
                                                <option value="fas fa-venus-double" <?php if($info['icon'] == 'fas fa-venus-double'){ echo 'selected'; } ?> data-select2-id="select2-data-1382-btq8">
                                                    &lt;i class="fas fa-venus-double"&gt;&lt;/i&gt; Venus Double
                                                </option>
                                                <option value="fas fa-venus-mars" <?php if($info['icon'] == 'fas fa-venus-mars'){ echo 'selected'; } ?> data-select2-id="select2-data-1383-wwxq">
                                                    &lt;i class="fas fa-venus-mars"&gt;&lt;/i&gt; Venus Mars
                                                </option>
                                                <option value="fab fa-viacoin" <?php if($info['icon'] == 'fab fa-viacoin'){ echo 'selected'; } ?> data-select2-id="select2-data-1386-augm">
                                                    &lt;i class="fab fa-viacoin"&gt;&lt;/i&gt; Viacoin
                                                </option>
                                                <option value="fab fa-viadeo" <?php if($info['icon'] == 'fab fa-viadeo'){ echo 'selected'; } ?> data-select2-id="select2-data-1387-oixz">
                                                    &lt;i class="fab fa-viadeo"&gt;&lt;/i&gt; Viadeo
                                                </option>
                                                <option value="fab fa-viadeo-square" <?php if($info['icon'] == 'fab fa-viadeo-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1388-vymg">
                                                    &lt;i class="fab fa-viadeo-square"&gt;&lt;/i&gt; Viadeo Square
                                                </option>
                                                <option value="fas fa-vial" <?php if($info['icon'] == 'fas fa-vial'){ echo 'selected'; } ?> data-select2-id="select2-data-1389-g8pk">
                                                    &lt;i class="fas fa-vial"&gt;&lt;/i&gt; Vial
                                                </option>
                                                <option value="fas fa-vials" <?php if($info['icon'] == 'fas fa-vials'){ echo 'selected'; } ?> data-select2-id="select2-data-1390-5zwm">
                                                    &lt;i class="fas fa-vials"&gt;&lt;/i&gt; Vials
                                                </option>
                                                <option value="fab fa-viber" <?php if($info['icon'] == 'fab fa-viber'){ echo 'selected'; } ?> data-select2-id="select2-data-1391-e5mc">
                                                    &lt;i class="fab fa-viber"&gt;&lt;/i&gt; Viber
                                                </option>
                                                <option value="fas fa-video" <?php if($info['icon'] == 'fas fa-video'){ echo 'selected'; } ?> data-select2-id="select2-data-1392-lgpr">
                                                    &lt;i class="fas fa-video"&gt;&lt;/i&gt; Video
                                                </option>
                                                <option value="fas fa-video-slash" <?php if($info['icon'] == 'fas fa-video-slash'){ echo 'selected'; } ?> data-select2-id="select2-data-1393-v5fz">
                                                    &lt;i class="fas fa-video-slash"&gt;&lt;/i&gt; Video Slash
                                                </option>
                                                <option value="fab fa-vimeo" <?php if($info['icon'] == 'fab fa-vimeo'){ echo 'selected'; } ?> data-select2-id="select2-data-1395-l05d">
                                                    &lt;i class="fab fa-vimeo"&gt;&lt;/i&gt; Vimeo
                                                </option>
                                                <option value="fab fa-vimeo-square" <?php if($info['icon'] == 'fab fa-vimeo-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1396-otvl">
                                                    &lt;i class="fab fa-vimeo-square"&gt;&lt;/i&gt; Vimeo Square
                                                </option>
                                                <option value="fab fa-vimeo-v" <?php if($info['icon'] == 'fab fa-vimeo-v'){ echo 'selected'; } ?> data-select2-id="select2-data-1397-e7gg">
                                                    &lt;i class="fab fa-vimeo-v"&gt;&lt;/i&gt; Vimeo
                                                </option>
                                                <option value="fab fa-vine" <?php if($info['icon'] == 'fab fa-vine'){ echo 'selected'; } ?> data-select2-id="select2-data-1398-bw8l">
                                                    &lt;i class="fab fa-vine"&gt;&lt;/i&gt; Vine
                                                </option>
                                                <option value="fab fa-vk" <?php if($info['icon'] == 'fab fa-vk'){ echo 'selected'; } ?> data-select2-id="select2-data-1402-457p">
                                                    &lt;i class="fab fa-vk"&gt;&lt;/i&gt; VK
                                                </option>
                                                <option value="fab fa-vnv" <?php if($info['icon'] == 'fab fa-vnv'){ echo 'selected'; } ?> data-select2-id="select2-data-1403-1u9r">
                                                    &lt;i class="fab fa-vnv"&gt;&lt;/i&gt; VNV
                                                </option>
                                                <option value="fas fa-volleyball-ball" <?php if($info['icon'] == 'fas fa-volleyball-ball'){ echo 'selected'; } ?> data-select2-id="select2-data-1405-k3d8">
                                                    &lt;i class="fas fa-volleyball-ball"&gt;&lt;/i&gt; Volleyball Ball
                                                </option>
                                                <option value="fas fa-volume-down" <?php if($info['icon'] == 'fas fa-volume-down'){ echo 'selected'; } ?> data-select2-id="select2-data-1406-jwic">
                                                    &lt;i class="fas fa-volume-down"&gt;&lt;/i&gt; Volume Down
                                                </option>
                                                <option value="fas fa-volume-off" <?php if($info['icon'] == 'fas fa-volume-off'){ echo 'selected'; } ?> data-select2-id="select2-data-1408-uwdl">
                                                    &lt;i class="fas fa-volume-off"&gt;&lt;/i&gt; Volume Off
                                                </option>
                                                <option value="fas fa-volume-up" <?php if($info['icon'] == 'fas fa-volume-up'){ echo 'selected'; } ?> data-select2-id="select2-data-1409-ss3m">
                                                    &lt;i class="fas fa-volume-up"&gt;&lt;/i&gt; Volume Up
                                                </option>
                                                <option value="fab fa-vuejs" <?php if($info['icon'] == 'fab fa-vuejs'){ echo 'selected'; } ?> data-select2-id="select2-data-1412-f8q3">
                                                    &lt;i class="fab fa-vuejs"&gt;&lt;/i&gt; Vue.js
                                                </option>
                                                <option value="fas fa-walking" <?php if($info['icon'] == 'fas fa-walking'){ echo 'selected'; } ?> data-select2-id="select2-data-1413-5aiz">
                                                    &lt;i class="fas fa-walking"&gt;&lt;/i&gt; Walking
                                                </option>
                                                <option value="fas fa-wallet" <?php if($info['icon'] == 'fas fa-wallet'){ echo 'selected'; } ?> data-select2-id="select2-data-1414-jcu0">
                                                    &lt;i class="fas fa-wallet"&gt;&lt;/i&gt; Wallet
                                                </option>
                                                <option value="fas fa-warehouse" <?php if($info['icon'] == 'fas fa-warehouse'){ echo 'selected'; } ?> data-select2-id="select2-data-1415-sdn2">
                                                    &lt;i class="fas fa-warehouse"&gt;&lt;/i&gt; Warehouse
                                                </option>
                                                <option value="fab fa-weibo" <?php if($info['icon'] == 'fab fa-weibo'){ echo 'selected'; } ?> data-select2-id="select2-data-1421-r9o4">
                                                    &lt;i class="fab fa-weibo"&gt;&lt;/i&gt; Weibo
                                                </option>
                                                <option value="fas fa-weight" <?php if($info['icon'] == 'fas fa-weight'){ echo 'selected'; } ?> data-select2-id="select2-data-1422-auig">
                                                    &lt;i class="fas fa-weight"&gt;&lt;/i&gt; Weight
                                                </option>
                                                <option value="fab fa-weixin" <?php if($info['icon'] == 'fab fa-weixin'){ echo 'selected'; } ?> data-select2-id="select2-data-1424-gxyq">
                                                    &lt;i class="fab fa-weixin"&gt;&lt;/i&gt; Weixin (WeChat)
                                                </option>
                                                <option value="fab fa-whatsapp" <?php if($info['icon'] == 'fab fa-whatsapp'){ echo 'selected'; } ?> data-select2-id="select2-data-1425-598b">
                                                    &lt;i class="fab fa-whatsapp"&gt;&lt;/i&gt; What's App
                                                </option>
                                                <option value="fab fa-whatsapp-square" <?php if($info['icon'] == 'fab fa-whatsapp-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1426-54ov">
                                                    &lt;i class="fab fa-whatsapp-square"&gt;&lt;/i&gt; What's App Square
                                                </option>
                                                <option value="fas fa-wheelchair" <?php if($info['icon'] == 'fas fa-wheelchair'){ echo 'selected'; } ?> data-select2-id="select2-data-1427-p9bt">
                                                    &lt;i class="fas fa-wheelchair"&gt;&lt;/i&gt; Wheelchair
                                                </option>
                                                <option value="fab fa-whmcs" <?php if($info['icon'] == 'fab fa-whmcs'){ echo 'selected'; } ?> data-select2-id="select2-data-1428-h2qq">
                                                    &lt;i class="fab fa-whmcs"&gt;&lt;/i&gt; WHMCS
                                                </option>
                                                <option value="fas fa-wifi" <?php if($info['icon'] == 'fas fa-wifi'){ echo 'selected'; } ?> data-select2-id="select2-data-1429-wevu">
                                                    &lt;i class="fas fa-wifi"&gt;&lt;/i&gt; WiFi
                                                </option>
                                                <option value="fab fa-wikipedia-w" <?php if($info['icon'] == 'fab fa-wikipedia-w'){ echo 'selected'; } ?> data-select2-id="select2-data-1430-3hv7">
                                                    &lt;i class="fab fa-wikipedia-w"&gt;&lt;/i&gt; Wikipedia W
                                                </option>
                                                <option value="fas fa-window-close" <?php if($info['icon'] == 'fas fa-window-close'){ echo 'selected'; } ?> data-select2-id="select2-data-1432-d4ot">
                                                    &lt;i class="fas fa-window-close"&gt;&lt;/i&gt; Window Close
                                                </option>
                                                <option value="fas fa-window-maximize" <?php if($info['icon'] == 'fas fa-window-maximize'){ echo 'selected'; } ?> data-select2-id="select2-data-1433-9hir">
                                                    &lt;i class="fas fa-window-maximize"&gt;&lt;/i&gt; Window Maximize
                                                </option>
                                                <option value="fas fa-window-minimize" <?php if($info['icon'] == 'fas fa-window-minimize'){ echo 'selected'; } ?> data-select2-id="select2-data-1434-w8yh">
                                                    &lt;i class="fas fa-window-minimize"&gt;&lt;/i&gt; Window Minimize
                                                </option>
                                                <option value="fas fa-window-restore" <?php if($info['icon'] == 'fas fa-window-restore'){ echo 'selected'; } ?> data-select2-id="select2-data-1435-ur9i">
                                                    &lt;i class="fas fa-window-restore"&gt;&lt;/i&gt; Window Restore
                                                </option>
                                                <option value="fab fa-windows" <?php if($info['icon'] == 'fab fa-windows'){ echo 'selected'; } ?> data-select2-id="select2-data-1436-ruvo">
                                                    &lt;i class="fab fa-windows"&gt;&lt;/i&gt; Windows
                                                </option>
                                                <option value="fas fa-wine-glass" <?php if($info['icon'] == 'fas fa-wine-glass'){ echo 'selected'; } ?> data-select2-id="select2-data-1438-uaz0">
                                                    &lt;i class="fas fa-wine-glass"&gt;&lt;/i&gt; Wine Glass
                                                </option>
                                                <option value="fab fa-wolf-pack-battalion" <?php if($info['icon'] == 'fab fa-wolf-pack-battalion'){ echo 'selected'; } ?> data-select2-id="select2-data-1443-3vyt">
                                                    &lt;i class="fab fa-wolf-pack-battalion"&gt;&lt;/i&gt; Wolf Pack Battalion
                                                </option>
                                                <option value="fas fa-won-sign" <?php if($info['icon'] == 'fas fa-won-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1444-3pup">
                                                    &lt;i class="fas fa-won-sign"&gt;&lt;/i&gt; Won Sign
                                                </option>
                                                <option value="fab fa-wordpress" <?php if($info['icon'] == 'fab fa-wordpress'){ echo 'selected'; } ?> data-select2-id="select2-data-1445-9miw">
                                                    &lt;i class="fab fa-wordpress"&gt;&lt;/i&gt; WordPress Logo
                                                </option>
                                                <option value="fab fa-wordpress-simple" <?php if($info['icon'] == 'fab fa-wordpress-simple'){ echo 'selected'; } ?> data-select2-id="select2-data-1446-xgaj">
                                                    &lt;i class="fab fa-wordpress-simple"&gt;&lt;/i&gt; Wordpress Simple
                                                </option>
                                                <option value="fab fa-wpbeginner" <?php if($info['icon'] == 'fab fa-wpbeginner'){ echo 'selected'; } ?> data-select2-id="select2-data-1447-tz7o">
                                                    &lt;i class="fab fa-wpbeginner"&gt;&lt;/i&gt; WPBeginner
                                                </option>
                                                <option value="fab fa-wpexplorer" <?php if($info['icon'] == 'fab fa-wpexplorer'){ echo 'selected'; } ?> data-select2-id="select2-data-1448-knc6">
                                                    &lt;i class="fab fa-wpexplorer"&gt;&lt;/i&gt; WPExplorer
                                                </option>
                                                <option value="fab fa-wpforms" <?php if($info['icon'] == 'fab fa-wpforms'){ echo 'selected'; } ?> data-select2-id="select2-data-1449-t23k">
                                                    &lt;i class="fab fa-wpforms"&gt;&lt;/i&gt; WPForms
                                                </option>
                                                <option value="fas fa-wrench" <?php if($info['icon'] == 'fas fa-wrench'){ echo 'selected'; } ?> data-select2-id="select2-data-1451-6wo7">
                                                    &lt;i class="fas fa-wrench"&gt;&lt;/i&gt; Wrench
                                                </option>
                                                <option value="fas fa-x-ray" <?php if($info['icon'] == 'fas fa-x-ray'){ echo 'selected'; } ?> data-select2-id="select2-data-1452-tydl">
                                                    &lt;i class="fas fa-x-ray"&gt;&lt;/i&gt; X-Ray
                                                </option>
                                                <option value="fab fa-xbox" <?php if($info['icon'] == 'fab fa-xbox'){ echo 'selected'; } ?> data-select2-id="select2-data-1453-wmmu">
                                                    &lt;i class="fab fa-xbox"&gt;&lt;/i&gt; Xbox
                                                </option>
                                                <option value="fab fa-xing" <?php if($info['icon'] == 'fab fa-xing'){ echo 'selected'; } ?> data-select2-id="select2-data-1454-hrdv">
                                                    &lt;i class="fab fa-xing"&gt;&lt;/i&gt; Xing
                                                </option>
                                                <option value="fab fa-xing-square" <?php if($info['icon'] == 'fab fa-xing-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1455-940v">
                                                    &lt;i class="fab fa-xing-square"&gt;&lt;/i&gt; Xing Square
                                                </option>
                                                <option value="fab fa-y-combinator" <?php if($info['icon'] == 'fab fa-y-combinator'){ echo 'selected'; } ?> data-select2-id="select2-data-1456-247e">
                                                    &lt;i class="fab fa-y-combinator"&gt;&lt;/i&gt; Y Combinator
                                                </option>
                                                <option value="fab fa-yahoo" <?php if($info['icon'] == 'fab fa-yahoo'){ echo 'selected'; } ?> data-select2-id="select2-data-1457-n75d">
                                                    &lt;i class="fab fa-yahoo"&gt;&lt;/i&gt; Yahoo Logo
                                                </option>
                                                <option value="fab fa-yandex" <?php if($info['icon'] == 'fab fa-yandex'){ echo 'selected'; } ?> data-select2-id="select2-data-1459-e3ya">
                                                    &lt;i class="fab fa-yandex"&gt;&lt;/i&gt; Yandex
                                                </option>
                                                <option value="fab fa-yandex-international" <?php if($info['icon'] == 'fab fa-yandex-international'){ echo 'selected'; } ?> data-select2-id="select2-data-1460-q7x8">
                                                    &lt;i class="fab fa-yandex-international"&gt;&lt;/i&gt; Yandex International
                                                </option>
                                                <option value="fab fa-yelp" <?php if($info['icon'] == 'fab fa-yelp'){ echo 'selected'; } ?> data-select2-id="select2-data-1462-qv3b">
                                                    &lt;i class="fab fa-yelp"&gt;&lt;/i&gt; Yelp
                                                </option>
                                                <option value="fas fa-yen-sign" <?php if($info['icon'] == 'fas fa-yen-sign'){ echo 'selected'; } ?> data-select2-id="select2-data-1463-yc06">
                                                    &lt;i class="fas fa-yen-sign"&gt;&lt;/i&gt; Yen Sign
                                                </option>
                                                <option value="fab fa-yoast" <?php if($info['icon'] == 'fab fa-yoast'){ echo 'selected'; } ?>data-select2-id="select2-data-1465-1oq1">
                                                    &lt;i class="fab fa-yoast"&gt;&lt;/i&gt; Yoast
                                                </option>
                                                <option value="fab fa-youtube" <?php if($info['icon'] == 'fab fa-youtube'){ echo 'selected'; } ?> data-select2-id="select2-data-1466-l5x8">
                                                    &lt;i class="fab fa-youtube"&gt;&lt;/i&gt; YouTube
                                                </option>
                                                <option value="fab fa-youtube-square" <?php if($info['icon'] == 'fab fa-youtube-square'){ echo 'selected'; } ?> data-select2-id="select2-data-1467-qumh">
                                                    &lt;i class="fab fa-youtube-square"&gt;&lt;/i&gt; YouTube Square
                                                </option>
                                            </select>
                                         </div>
                                    </div>
                                </div>
                            <input type="hidden" name="submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

<script>

    // reference: https://jsfiddle.net/qCn6p/208/

function formatText (icon) {
    return $('<span><i class=" ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
};

$('.select2-icon').select2({
    width: "100%",
    templateSelection: formatText,
    templateResult: formatText
});
    
</script>

