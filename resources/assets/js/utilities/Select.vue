<template>
    <div>
        <select class="js-data-example-ajax">
            <option value="AL">Alabama</option>
            <option value="WY">Wyoming</option>
        </select>
    </div>
</template>

<script>

export default{

    props :{
        items :{
            required : false,
        },
        plaseholder:{
            required:false
        },
        url : {
            required:false
        }
    },
    data(){
        return{
            id:Math.random(),
            query : '',
            list : [],
        }
    },
    created:function () {
        console.log('create in component Select.vue');
        $('.js-data-example-ajax').select2();
    },
}



</script>