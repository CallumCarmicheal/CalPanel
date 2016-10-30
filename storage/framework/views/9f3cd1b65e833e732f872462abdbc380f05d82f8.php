<?php 
	$h_u_m_defaultIcon = "https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128";
	$grava_url		   = Auth::user()->getGravatar();
?>

<div class="tab-pane fade in active" id="messages">
	<div class="col-md-4">
		<div class="message-list-overlay">
            <div class="inputer inputer-blue" style="padding-left: 25px; padding-right: 25px">
                <div class="input-wrapper">
                    <textarea id="send-message-input" rows="1" id="message-user-query" class="form-control js-auto-size" placeholder="Query..."></textarea>
                </div>
            </div>
        </div>
        
        
        <ul id="message-user-list" class="list-material message-list">
			<!-- TODO: Create a view of the previous messages -->
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="1">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Pari Subramanium</span>
						<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>
					</div>
					<div class="list-action-right">
						<span class="top">15 min</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="2">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Andrew Fox</span>
						<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI. Efficiently unleash cross-media information without cross-media value.</span>
					</div>
					<div class="list-action-right">
						<span class="top">2 hr</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="3">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Lieke Vermeulen</span>
						<span class="caption">Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</span>
					</div>
					<div class="list-action-right">
						<span class="top">Yesterday</span>
						<i class="ion-android-volume-off bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="4">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Benjamin Beck</span>
						<span class="caption">Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.</span>
					</div>
					<div class="list-action-right">
						<span class="top">1 week ago</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="5">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Joshua Harris</span>
						<span class="caption">Dynamically innovate resource-leveling customer service for state of the art customer service. Objectively innovate empowered manufactured products whereas parallel platforms.</span>
					</div>
					<div class="list-action-right">
						<span class="top">Jan 10, 2015</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="1">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Lisa Cooper</span>
						<span class="caption">Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</span>
					</div>
					<div class="list-action-right">
						<span class="top">Jan 5, 2015</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="2">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Matthew Harris</span>
						<span class="caption">Globally incubate standards compliant channels before scalable benefits. </span>
					</div>
					<div class="list-action-right">
						<span class="top">Jan 4, 2015</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
			<li class="has-action-left has-action-right">
				<a href="#" class="visible" data-message-id="3">
					<div class="list-action-left">
						<img src="<?php echo e($h_u_m_defaultIcon); ?>" class="face-radius" alt="">
					</div>
					<div class="list-content">
						<span class="title">Diana Nguyen</span>
						<span class="caption">Happy new yeaar!!</span>
					</div>
					<div class="list-action-right">
						<span class="top">Jan 1, 2015</span>
						<i class="ion-android-done bottom"></i>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<div class="col-md-8">
		<div class="message-send-container" style="display: none;">
			<div class="messages"> </div>
            
			<div class="send-message">

                <div class="input-group">
                    <div class="inputer inputer-blue">
                        <div class="input-wrapper">
                            <textarea id="send-message-input" rows="1" id="send-message-input" class="form-control js-auto-size" placeholder="Message"></textarea>
                        </div>
                    </div>
		
                    <span class="input-group-btn">
                        <button id="send-message-button" class="btn btn-blue" type="button">Send</button>
                    </span>
                </div>
			</div>
		</div>
	</div>
	<div class="mobile-back">
		<div class="mobile-back-button"><i class="ion-android-arrow-back"></i></div>
	</div>
</div>
