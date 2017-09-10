<template>
    <div style="text-align: center;">
    	<my-upload field="img"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            v-model="show"
    		:width="150"
    		:height="150"
    		url="/avatar"
    		:params="params"
    		:headers="headers"
    		img-format="png"></my-upload>
    	<img :src="imgDataUrl" width="80">
        <div style="margin-top: 20px;">
            <button class="btn btn-default" @click="toggleShow">修改头像</button>
        </div>
    </div>
</template>

<script>
    import 'babel-polyfill'; // es6 shim
	import myUpload from 'vue-image-crop-upload';

    export default {
        props: ['avatar', 'token'],
        data() {
			return {
                show: false,
    			params: {
    				_token: this.token,
    				name: 'img'
    			},
    			headers: {
    				smail: '*_~'
    			},
    			imgDataUrl: this.avatar
            }
		},
		components: {
			'my-upload': myUpload
		},
		methods: {
			toggleShow() {
				this.show = !this.show;
			},
            /**
			 * crop success
			 *
			 * [param] imgDataUrl
			 * [param] field
			 */
			cropSuccess(imgDataUrl, field){
				this.imgDataUrl = imgDataUrl;
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
			cropUploadSuccess(response, field){
				this.imgDataUrl = response.url
                this.toggleShow()

			},
			/**
			 * upload fail
			 *
			 * [param] status    server api return error status, like 500
			 * [param] field
			 */
			cropUploadFail(status, field){
				console.log('-------- upload fail --------');
				console.log(status);
				console.log('field: ' + field);
			}
		}
    }
</script>
