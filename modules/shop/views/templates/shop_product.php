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
        <div style="width: 100%; height: 700px">
            <div id="mainLeft">
                <div class="spacerLeft50px">
                </div>
                <div id="leftMainLogo">
                    <img src="Styles/Images/fwlogo.jpg" style="margin-left: 4%" />
                </div>
                <div id="leftMenuLink">
                    <div class="sideLink1">
                        <a href="#">Log in</a></div>
                    <div class="sideLink1 sidelinkBreak">
                        <a href="#">Register</a></div>
                    <div class="sideLink2 sidelinkBreak">
                        <a href="#">Show all</a></div>
                    <div class="sideLink2 sidelinkBreak">
                        <a href="#">Pig Feeds</a></div>
                    <div class="sideLink2 sidelinkBreak">
                        <a href="#">Chicken Feeds</a></div>
                    <div class="sideLink2">
                        <a href="#">Other</a></div>
                </div>
                <div id="leftBoxSummary">
                    <div class="boxSummaryUpper titleOswald">
                        Shopping Cart</div>
                    <div class="boxSummaryLower">
                        Items in your cart <b>0</b></div>
                </div>
            </div>
            <div id="mainRight2">
                <div id="rightPlainContent">
                    <div style="width: 660px; height: 500px; margin-left: auto; margin-right: auto; margin-top: 100px;">
                        
                        <div id="tpl-shop" class="module">
                    
                        <div class="col col1">
                    
                            {if errors}
                                <div class="error">
                                    {errors}
                                </div>
                            {/if}
                            {if message}
                                <div class="message">
                                    {message}
                                </div>
                            {/if}			
                            
                            <form method="post" action="/shop/cart/add" class="default">
                            
                                <div class="description">
                            
                                    <input type="hidden" name="productID" value="{product:id}" />
                                    
                                    <h1>{product:title}</h1>
                    
                                    {if product:subtitle}
                                    
                                        <h2>{product:subtitle}</h2>
                                        
                                    {/if}
                                    
                                    {product:body}
                    
                                    <div id="reviews">
                        
                                        <h3>Reviews</h3>
                    
                                        {if product:reviews}
                                            
                                            {product:reviews}
                                            <div class="review {review:class}" id="review{review:id}">
                        
                                                <div class="col1">
                                                    <img src="{review:gravatar}" width="50" />
                                                </div>
                                
                                                <div class="col2">
                                                    <img src="http://static.feedworld.com/themes/default/images/rating{review:rating}.gif" alt="{review:rating} Rating" class="rating" />
                                                    
                                                    <p>By <strong>{review:author}</strong> <small>on {review:date}</small></p>
                                                                
                                                    <p>{review:body}</p>
                                                </div>
                        
                                            </div>
                                            <div class="clear"></div>
                                            {/product:reviews}
                    
                                        {else}
                    
                                            <p><small>There are currently no reviews</small></p>
                    
                                        {/if}						
                    
                                    </div>
                    
                                    <p>
                                        <a href="/shop/recommend/{product:id}" class="loader">Recommend this product</a><br />
                                        <a href="/shop/review/{product:id}" class="loader">Write a review</a>						
                                    </p>					
                                            
                                </div>
                                            
                                <div class="purchase">
                                
                                    {if product:image-path}
                                    
                                        <p><a href="{product:image-path}" title="{product:title}" class="lightbox"><img src="{product:image-path}" alt="{product:title}" class="productpic" width="178" /></a></p>
                            
                                    {else}
                                    
                                        <p><img src="http://static.feedworld.com/images/noimage.gif" alt="Product image" class="productpic" /></p>
                    
                                    {/if}
                                    
                                    <p>{product:status}</p>
                                    
                                    <p><strong>{product:price}</strong></p>
                            
                                    {product:variations}				
                            
                                    <br class="clear" />
                                    
                                    {if product:stock}
                                        <input type="submit" value="Add to Cart" class="button" />
                                    {/if}
                                </div>
                            </form>
                    
                        </div>
                        <div class="col col2">
                    
                            <h3>Categories</h3>
                        
                            <ul class="menu">
                                {shop:categories}
                            </ul>
                            
                        </div>
                    
                        </div>

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

	
{include:footer}