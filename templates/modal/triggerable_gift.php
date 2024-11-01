<article class='wc-timeline-product flex-row-between fake-product'>
            <div class="wjcfw-fake-product--overlay">
                <div class="wjcfw-fake-product--text">
                    <?php echo $gift['banner_text'] ?? '' ?>
                    <i class="wooj-icon-gift"></i>
                </div>
            </div>	
            <div class='wc-timeline-product-data flex-row-start'>	
							<div class='image'>					
									
								<div class='qty flex-row-center'>
                                    <?php echo $gift['quantity'] ?>
								</div>	

                                <?php if (!empty( woo_j_conf('label_gift') ) ): ?>	

                                    <div class="special discounted">
                                        <?php echo wjc__( esc_html( woo_j_conf('label_gift')), 'label_gift' ) ?>
                                    </div>

                                <?php endif; ?>
								
                                <?php echo $gift['woo_product']->get_image( 'thumbnail' ) ?>
								<!-- Labels -->							
							</div>						
							
							<div class='heading flex-column-start'>
							
									<div style="position:relative;width:100%;">	
											<div class='wc-timeline-product-title'>
												<?php echo $gift['woo_product']->get_name() ?>											
                                            </div>

                                            <div class="upsell-text">
                                                <?php echo $gift['text'] ?>	
                                            </div>							
									</div>	
							</div>
					</div>
					
					<div class='options flex-column-center'>
							<div></div>		
                            <div class="flex-row-end wc-timeline-price-container">
                                    <div class='wc-timeline-product-price'>
                                        <?php echo wjc__( esc_html( woo_j_conf('text_free_product')), 'text_free_product' ) ?>						
                                    </div>									
                            </div>							
					</div>	
</article>


