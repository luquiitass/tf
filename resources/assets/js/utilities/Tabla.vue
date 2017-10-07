<template>
  <div class="dv">

    <div v-if="loading">
      <div id="loading" style="background-color: #f9f9f9;padding: 10px;display: block;align-items: center">
        <p class="text-center" >
          <img style="padding: 20px;" src="img/loading.gif" alt="">
        </p>
        <p class="text-center">Cargando...</p>
      </div>
    </div> <!--Loading-->

    <div v-else>


      <div class="dv-header">
        <div class="row">
          <div class="col-xs-12 col-md-4">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar por..." v-model="query.search_input">
              <span class="input-group-btn">
              <button class="btn btn-secondary" type="button"  @click="search()">Buscar</button>
            </span>
            </div>
          </div>
          <div class="col-xs-12 col-md-8">
            <div class="pull-right">
              <a  class="btn btn-default btn-xs " target="_blank" @click="pdf()">PDF</a>
              <a  class="btn btn-default btn-xs " target="_blank" @click="toggleFiltro()">Filtrar</a>
          </div>
          </div>
        </div>

      </div>

      <div class="dv-header" id="filtro" style="display: none">

        <div class="dv-header-columns">
          <span class="dv-header-pre">Por: </span>
          <select class="dv-header-select" v-model="query.search_column">
            <option v-for="(value,key) in columns" :value="key">{{value}}</option>
          </select>
        </div>

        <div class="dv-header-operators">
          <select class="dv-header-select" v-model="query.search_operator">
            <option v-for="(value, key) in operators" :value="key">{{value}}</option>
          </select>
        </div>

        <div class="dv-header-search">
          <input type="text" class="dv-header-input"
                 placeholder="Valor"
                 v-model="query.search_input"
          @keyup.enter="filter()">
        </div>

        <div class="dv-header-submit">
          <button class="dv-header-btn" @click="filter()">Filtrar</button>
        </div>

      </div>

      <div class="dv-body">
        <table class="table">
          <thead>
            <tr>
              <th v-for="(column,key) in columns" @click="toggleOrder(key)">
                <span>{{column}}</span>
                <span class="dv-table-column" v-if="key === query.column">
                      <span v-if="query.direction === 'desc'">&uarr;</span>
                      <span v-else>&darr;</span>
                    </span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!items.lenght" v-for="row in items" @click="selectRow(row)" :class="classRow(row)">
              <td v-for="(value,key) in columns">{{row[key]}}</td>
            </tr>
          </tbody>
        </table>
        <div v-if="items.lenght" class="text-center">
          <h3>No se han encontrado registros</h3>
        </div>
      </div>

      <div class="dv-footer">
        <div class="dv-footer-item">
          <span>Mostrando {{model.from}} - {{model.to}} of {{model.total}} filas</span>
        </div>

        <div class="dv-footer-item">
          <div class="dv-footer-sub">
            <span>Filas por pagina</span>
            <input type="text" v-model="query.per_page"
                   class="dv-footer-input"
            @keyup.enter="filter()">
          </div>

          <div class="dv-footer-sub">
            <button class="dv-footer-btn" @click="prev()">&laquo;</button>
            <input type="text" v-model="query.page"
                 class="dv-footer-input"
          @keyup.enter="filter()">
            <button class="dv-footer-btn" @click="next()">&raquo;</button>
          </div>
        </div>
      </div>
    </div> <!-- Fin del else-->
  </div>
</template>
<script>
  import Vue from 'vue'
  import axios from 'axios'
  //similar to vue-resource

  export default {
    props: ['source', 'title','list','itemSelected','attributes'],
    data() {
      return {
        loading:false,
        items:{},
        itemSelect:{},
        model:{},
        columns: {},
        query: {
          page: 1,
          column: Object.keys(this.attributes)[0],
          direction: 'desc',
          per_page: 15,
          search_column: Object.keys(this.attributes)[0],
          search_operator: 'equal',
          search_input: ''
        },
        operators: {
          equal: '=',
          not_equal: '<>',
          less_than: '<',
          greater_than: '>',
          less_than_or_equal_to: '<=',
          greater_than_or_equal_to: '>=',
          in: 'IN',
          like: 'LIKE'
        }
      }
    },
    computed:{
    },
    created() {
      this.columns = this.attributes
      Vue.set(this.$data, 'items', this.list)
      this.itemSelect= this.listSelected;
      this.filter()
    },
    watch:{
      items : function () {
          this.$emit('updatedList',this.items);
      },
      itemSelect:function () {
          this.$emit('selectItem',this.itemSelect);
      },
      itemSelected : function (value) {
          this.itemSelect = this.itemSelected;
      },
      list: function (value) {
        this.model.data = this.list;
      },
      query : function (value) {
        console.log(value);
        if (this.model.total){
          this.query.per_page = this.query.per_page > this.model.total ? this.model.total : this.query.per_page;
        }
      },
      attributes:function () {
        this.columns = this.attributes;
      }
    },
    methods: {
      next() {
        if(this.model.next_page_url) {
          this.query.page++
          this.filter()
        }
      },
      prev() {
        if(this.model.prev_page_url) {
          this.query.page--
          this.filter()
        }
      },
      toggleOrder(column) {
        if(column === this.query.column) {
          // only change direction
          if(this.query.direction === 'desc') {
            this.query.direction = 'asc'
          } else {
            this.query.direction = 'desc'
          }
        } else {
          this.query.column = column
          this.query.direction = 'asc'
        }
        this.filter();
      },
      toggleFiltro(){
        $('#filtro').toggle(1000);
      },
      pdf(){
        axios({
          method:'post',
          url:PATH + this.source,
          responseType:'arraybuffer',
          data: {query : this.query,columns : this.attributes , operation : 'pdf'}
        })
                .then(function(response) {
                  console.log(response);
                  let blob = new Blob([response.data], { type:   'application/pdf' } );
                  let link = document.createElement('a');
                  link.href = window.URL.createObjectURL(blob);
                  link.download = 'Report.pdf';
                  link.click();

                });
//        var form = new Form({query : this.query,columns : this.attributes , operation : 'pdf'});
//        form.submit('get',PATH + this.source)
//                .then(response=>{
//                  console.log(response);
//                }).catch(error=>{
//                  console.log(error);
//        });
      },
      filter(){
        if(this.query.search_operator == 'search'){
          this.query.search_operator = 'equal';
        }
        this.select('filter');
      },
      search(){
        this.query.search_operator = 'search';
        this.select('search');
      },
      select(operation){
        var form = new Form({query : this.query,columns : this.attributes , operation : operation});
        this.loading = true;
        var vmm = this;
        form.post(PATH + this.source)
                .then(response =>{
                  vmm.model = response.model;

                  vmm.setItems();
                  vmm.loading = false;
                  vmm.selectRow(null);
                })
                .catch(error=>{
                  console.log(error);
                  vmm.loading = false;
                  vmm.selectRow(null);
                });
      },

      fetchIndexData() {
        this.loading = true;
        var vmm = this
        axios.get(`${PATH + this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
          .then(function(response) {
            Vue.set(vmm.$data, 'model', response.data.model)
            Vue.set(vmm.$data, 'columns', response.data.columns)

            vmm.setItems();
            vmm.loading = false;
            vmm.selectRow(null);
          })
          .catch(function(response) {
            console.log(response)
            vmm.loading = false;

          })
      },
      classRow(row){
        return this.itemSelect == row ? 'tr-active' : 'tr-list';
      },
      selectRow(item){
        this.itemSelect = item;
      },
      setItems(){
        this.items = this.model.data;
      }
    }
  }
</script>