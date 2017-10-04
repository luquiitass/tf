<template>
    <div>
        <div class="input-group btn-block">
            <input class="form-control" type="text" v-model="stringSearch" :placeholder="placeholder" @keyup="find"/>
            <i v-if="loading" class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
            <span v-if="loading" class="input-group-btn fa fa-spinner"></span>
        </div>

        <div v-if="!m_items.lenght">
            <ul class="list-group">
                <slot name="li-items">
                    <li
                            class="list-group-item"
                            v-for="item in m_items"
                            @click="itemSelected(item)">

                        {{item.text}}
                    </li>

                </slot>
            </ul>

        </div>

    </div>
</template>

<script>

export default{

    props:{
        url:{
            required:true,
        },
        minText:{
            default:2,
        },
        items:{
            default:[]
        },
        columns :{
            required:true,
        }
    },
    data(){
        return{
            stringSearch:'',
            placeholder :'Valor a buscar',
            loading : false,
            m_items :[],
        }
    },
    methods : {
        find(){
            console.log('quizo realizar una busqueda con ' + this.stringSearch + ',\nel tmaño de la palabra es  con las columnas ' + this.columns)
            if(this.stringSearch.length >= this.minText){
                this.loading = true;
                var parms = '?query='+ this.stringSearch +'&columns="' + this.columns+'"';
                axios.get(PATH + this.url +parms )
                        .then(response =>{
                            this.m_items = response.data;
                            this.loading = false;
                        })
                        .catch(error => {
                            this.loading = false;
                            console.log(error);
                        });
            }else {
                this.m_items = [];
            }
            },
        itemSelected(item){
                this.m_items =[];
                this.stringSearch = '',
                this.$emit('itemSelected',item);
        }
    }



}
</script>