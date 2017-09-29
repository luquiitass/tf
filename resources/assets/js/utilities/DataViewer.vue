<template>
  <div class="dv">
    <div class="dv-header">
      <div class="dv-header-title">
        {{title}}
      </div>
      <div class="dv-header-columns">
        <span class="dv-header-pre">Buscar: </span>
        <select class="dv-header-select" v-model="query.search_column">
          <option v-for="(value,key) in titles" :value="columns[key]">{{value}}</option>
        </select>
      </div>
      <div class="dv-header-operators">
        <select class="dv-header-select" v-model="query.search_operator">
          <option v-for="(value, key) in operators" :value="key">{{value}}</option>
        </select>
      </div>
      <div class="dv-header-search">
        <input type="text" class="dv-header-input"
          placeholder="buscar"
          v-model="query.search_input"
          @keyup.enter="fetchIndexData()">
      </div>
      <div class="dv-header-submit">
        <button class="dv-header-btn" @click="fetchIndexData()">Filtrar</button>
      </div>
    </div>
    <div class="dv-body">
      <table class="table">
        <thead>
          <tr>
            <th v-for="(column,key) in titles" @click="toggleOrder(columns[key])">
              <span>{{column}}</span>
              <span class="dv-table-column" v-if="columns[key] === query.column">
                <span v-if="query.direction === 'desc'">&uarr;</span>
                <span v-else>&darr;</span>
              </span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in items" @click="selectRow(row)" :class="classRow(row)">
            <td v-for="col in columns">{{row[col]}}</td>
          </tr>
        </tbody>
      </table>
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
            @keyup.enter="fetchIndexData()">
        </div>
        <div class="dv-footer-sub">
          <button class="dv-footer-btn" @click="prev()">&laquo;</button>
          <input type="text" v-model="query.page"
            class="dv-footer-input"
            @keyup.enter="fetchIndexData()">
          <button class="dv-footer-btn" @click="next()">&raquo;</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import Vue from 'vue'
  import axios from 'axios'
  //similar to vue-resource

  export default {
    props: ['source', 'title','list','itemSelected'],
    data() {
      return {
        items:{},
        itemSelect:{},
        model:{},
        columns: {},
        titles: {},
        query: {
          page: 1,
          column: 'id',
          direction: 'desc',
          per_page: 15,
          search_column: 'id',
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
    created() {
      //this.items = this.list;
      Vue.set(this.$data, 'items', this.list)
      this.itemSelect= this.listSelected;
      this.fetchIndexData()
    },
    watch:{
      items : function () {
          this.$emit('updatedList',this.items);
      },
      itemSelect:function () {
          this.$emit('selectItem',this.itemSelect);
      },
      list: function (value) {
        this.model.data = this.list;
      },
      query : function (value) {
        console.log(value);
        if (this.model.total){
          this.query.per_page = this.query.per_page > this.model.total ? this.model.total : this.query.per_page;
        }
      }
    },
    methods: {
      next() {
        if(this.model.next_page_url) {
          this.query.page++
          this.fetchIndexData()
        }
      },
      prev() {
        if(this.model.prev_page_url) {
          this.query.page--
          this.fetchIndexData()
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

        this.fetchIndexData()
      },
      fetchIndexData() {
        var vmm = this
        axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
          .then(function(response) {
            Vue.set(vmm.$data, 'model', response.data.model)
            Vue.set(vmm.$data, 'columns', response.data.columns)
            Vue.set(vmm.$data, 'titles', response.data.titles)

            vmm.setItems();
          })
          .catch(function(response) {
            console.log(response)
          })
      },
      classRow(row){
        return this.itemSelected == row ? 'tr-active' : 'tr-list';
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