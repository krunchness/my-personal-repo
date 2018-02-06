<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Fxbp_Scanner
 * @subpackage Fxbp_Scanner/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap fxbp-wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <div class="button-container">
        <div class="select-container" v-cloak v-if="scanIsClicked === false">
        <!-- <div class="select-container" v-cloak v-if="1 === 1"> -->
            <div class="input-container">
                <p><strong>Website Server(Required):</strong></p>
                <input type="radio" name="webServer" value="production" v-model="selected.serverType" checked>
                <label>Production Server</label>
                <br>
                <input type="radio" name="webServer" value="preview" v-model="selected.serverType">
                <label>Preview Server</label>
                <br>
                <span>Picked: {{ selected.serverType }}</span>
            </div>
            <div class="input-container">
                <p><strong>Type of Website(Required):</strong></p>
                <input type="radio" name="TypeOfWebsite" value="fx-default" v-model="selected.websiteType" checked>
                <label>Default Website</label>
                <br>
                <input type="radio" name="TypeOfWebsite" value="woocommerce" v-model="selected.websiteType">
                <label>Woocommerce Website</label>
                <br>
                <span>Picked: {{ selected.websiteType }}</span>
            </div>
            <div class="input-container">
                <p><strong>Company Brands(Required):</strong></p>
                <div class="brands-container" v-for="brand in brandList">
                    <input type="radio" name="companyBrand" v-bind:value="brand.abbrev" v-model="selected.brandType.abbreviation" v-on:change="setBrand(brand.name,brand.abbrev,brand.url,brand.email, brand.marketingEmail)">
                    <label >{{ brand.name }}</label>
                    <br>
                </div>
                <span>Picked: {{ selected.brandType.name }}</span>
            </div>
            
            <button v-on:click="scanValidate">Scan</button>
        </div>
        <!-- <button class="testingButton" style="float:left;">Scan</button> -->
    
        <div class="results-container" v-cloak v-else>
            <img src="<?php echo plugins_url().'/fxbp-scanner/public/images/spin.gif' ?>" class="loading-icon">
            <button v-on:click="scanIsClicked = false" style="display: block;">Rescan</button>
                <ul class="accordion">
                    <li>
                        <a class="toggle" href="javascript:void(0);">{{ selected.brandType.name }} Account</a>
                        <ul class="inner fxuser_container">
                        </ul>
                    </li>
            	   <li>
                        <a class="toggle" href="javascript:void(0);">Required Plugins</a>  
                        <ul class="inner plugins_container">
                        </ul>
                   </li>
                   <li>
                        <a class="toggle" href="javascript:void(0);">Unused Plugins</a>  
                        <ul class="inner deactivated_plugins">
                        </ul>
                   </li>
                   <li>
                        <a class="toggle" href="javascript:void(0);">Contact Form</a>  
                        <ul class="inner cform_fields">
                        </ul>
                   </li>
        
                   <li>
                        <a class="toggle" href="javascript:void(0);">Wordpress Files</a>  
                        <ul class="inner wordpress_files">
                        </ul>
                   </li>
                   <li>
                        <a class="toggle" href="javascript:void(0);">Wordpress Settings</a>  
                        <ul class="inner wordpress_settings">
                        </ul>
                   </li>
                   <li>
                        <a class="toggle" href="javascript:void(0);">User Capabilities</a>  
                        <ul class="inner user_capabilities">
                        </ul>
                   </li>
                   <li>
                        <a class="toggle" href="javascript:void(0);">Plugin versions</a>  
                        <ul class="inner plugin_versions">
                        </ul>
                   </li>
        </div>

    </div>
</div>
