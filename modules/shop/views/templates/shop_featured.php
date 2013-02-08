{include:header}
<div id="topbar">   
        <div id="topDetails">
           <span style="float: left; padding-top: 5px;"> Welcome!</span>  {if user}<span style="color:#00aad0; float: left; padding: 5px 0px 0px 5px;">{username}</span> {/if}
            <span style="float: right; padding: 5px 0px 0px 5px;">Proceed to checkout</span>
            <span style="float: right"><img src="/static/images/main/right_arrow.png" style="height: 25px; width: 25px;" alt=""/></span>
        </div>
    </div>
{include:navigation}
{include:banner}



<div id="bodyWrapper">
        <div id="bodyWrapperCenter">
            <div id="mainLeft">
                <div class="spacerLeft50px">
                </div>
                <div id="leftMainLogo">
                    <img src="/static/images/main/fwlogo.jpg" style="margin-left: 4%" />
                </div>
                <div id="leftMenuLink">
                   
                        {if user}
                         <div class="sideLink1">
                           <a href="/users/logout">Logout</a></div>
                        <div class="sideLink1">
                           <a href="/users">My Profile</a></div>
                        {else}
                         <div class="sideLink1">
                            <a href="/users/login">Log in</a></div>
                         <div class="sideLink1">
                           <a href="/users/create_account">Register</a></div>
                        {/if}
                    
                    <ul class="sideCategories">
                    	{shop:categories}
                        <li></li>
                    </ul>
                    <!--<div class="sideLink2 sidelinkBreak">
                        <a href="#">Show all</a></div>-->
                    
                </div>
                <div id="leftBoxSummary">
                    <div class="boxSummaryUpper titleOswald">
                        Shopping Cart</div>
                    <div class="boxSummaryLower">
                        Items in your cart <b>0</b></div>
                </div>
            </div>
            <div id="mainRight">
                <!--<div id="mainBanner">-->
                 {include:slider}
                 <!--</div>-->
                <div class="spacerRight10px">
                </div>
                <div id="mainContent">
                    <div id="bodyAnnouncement">
                    </div>
                    <div class="boarderHeader">
                        <div class="headerBG">
                        </div>
                    </div>
                    
                    	
		
                            <div id="bodyProducts">
                            {if shop:featured}
                                    {shop:featured}
                                        {product:rowpad}			
                                        <div class="productBox productBoxDivider">
											<a href="{product:link}">
											<div class="imageProduct"><img width="210px" height="176px" src="{product:thumb-path}" alt="Product image" class="productpic" /></div>
                                            <div class="productTitle">{product:title}</div>
											<div class="productBody">{product:excerpt}</div>
											<div class="productBottom">
											<div class="productBottomCost">{product:price}</div>
											<div class="productBottomAdd"></div>
											</a>
										</div>
                                    {/shop:featured}
                                    {rowpad:featured}
                             {else}
                    
                                <p><small>There are currently no featured products.</small></p>
                            
                            {/if}
                            
                             {if shop:latest}
		
                            
                                    {shop:latest}
                                        {product:rowpad}			
                                        <div class="productBox productBoxDivider">

											<a href="{product:link}">
											<div class="imageProduct"><img width="210px" height="176px" src="{product:thumb-path}" alt="Product image" class="productpic" /></div>
                                            <div class="productTitle">{product:title}</div>
											<div class="productBody">{product:excerpt}</div>
											<div class="productBottom">
											<div class="productBottomCost">{product:price}</div>
											<div class="productBottomAdd"></div>
											</a>

                                        </div>
                                    {/shop:latest}
                                    {rowpad:latest}
                        	
                        
                            {else}
                        
                                <p><small>There are currently no latest products.</small></p>
                            
                            {/if}
                        	</div>
                        
                        
                        
                       
                    
                    
                    
                        
                </div>
                <div id="bodyGrayBelow">
                    <div class="belowBox">
                        <div class="belowTitle">About Us</div>
                        <br />
                        <div class="belowLink">
                            <li><a href="#">About the Company</a></li></div>
                        <div class="belowLink">
                            <li><a href="#">FAQ</a></li></div>
                        <div class="belowLink">
                            <li><a href="#">Terms and Conditions</a></li></div>
                    </div>
                    <div class="belowBox">
                        <div class="belowTitle">News</div>
                        <br />
                        <div class="belowDetails">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis ornare nibh,
                                    vel condimentum risus blandit.. more</div>
                    </div>
                    <div class="belowBox">
                        <div class="belowTitle">Top Seller</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--End-->


	
{include:footer}