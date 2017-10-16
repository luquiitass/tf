<template>
    <div>
        <div class="input-group btn-block">
            <input class="form-control loading" type="text" v-model="stringSearch" :placeholder="placeholder" @keyup="find"/>
        </div>
        <slot name="showList">
            <div v-if="!m_items.lenght">
                <ul class="list-group">
                    <slot name="li-items">
                        <li
                            class="list-group-item manita"
                            v-for="item in m_items"
                            @click="itemSelected(item)">

                            <a title="Seleccionar">
                                {{item.text}}
                            </a>
                        </li>
                    </slot>
                </ul>
            </div>
        </slot>
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
            placeholder :'Buscar por ' + this.columns,
            loading : false,
            m_items :[],
        }
    },
    watch:{
        m_items(){
            this.$emit('update',this.m_items);
        }
    },
    methods : {
        find(){
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