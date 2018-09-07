<template>
	<div class="container home-padding">
	    <div class="row justify-content-center">
            <div class="col-md-12">
				<div class="card">
				    <div class="card-header card-header-center">
					    {{ card.header }}
					</div>
                    <div class="card-body main-background main-list main-shadow">
					<!-- normal -->
					<template v-if="card.status == true">

                        <!-- nothing -->
						<template v-if="card.content == []">
	    					<div class="img-wrapper"
		    					style="height:22em;
	    							background-image: url('/storage/404.png')">
    						</div>
			    		</template>
                        <!-- normal -->
                        <template v-else>
		    				<template v-for="item in card.content">
    							<div class="thumbnail col-md-3 col-xs-6 float-left" :key="item.id">
									<a :href="'/goods'+'/'+item.id">
									    <div class='img-wrapper'
										    :style="'background-image: url('+item.thumbnail.src+')'">
									    </div>
								    </a>
										<div class='caption'>
									    <h4 class='goods-title'>
										    {{ item.title }}
									    </h4>
									    <h5 class='goods-cost main-content'>
										    ￥ {{ item.cost }}
										</h5>
								    </div>
							    </div>
						    </template>
                        </template>
                        
						</template>
						<!-- empty -->
						<template v-else-if="card.status == false">
							<div class='text-info'>
								网络出了点小问题，刷新试试～
							</div>
						</template>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: [
		'card',
	],
	mounted() {
		console.log('HomeGoodCard mounted')
	}
}
</script>

