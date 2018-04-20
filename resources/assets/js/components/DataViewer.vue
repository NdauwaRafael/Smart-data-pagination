<script>
    import  Vue from 'vue'
    import axios from 'axios'
    export default {
        props: ['source', 'title'],
        data(){
            return {
                model: {},
                columns: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'asc',
                    per_page: 10,
                    search_id: 'id',
                    search_operator: 'equal',
                    search_input: ''
                },
                operators: {
                equal: '=',
                not_equal: '<>',
                less_than:'<',
                greater_than: '>',
                less_than_or_equal_to:'<=',
                greater_than_or_equal_to: '>='
                }
            }
        },
        created(){
            this.fetchIndexData()
        },
        methods: {
            next(){
                if(this.model.next_page_url){
                    this.query.page++
                    this.fetchIndexData()
                }
            },
            prev(){
                if(this.model.prev_page_url){
                    this.query.page--
                    this.fetchIndexData()
                }
            },
            toggleOrder(column){
                if (column===this.query.column){
                    if(this.query.direction==='asc'){
                        this.query.direction='desc'
                    }else{
                        this.query.direction='asc'
                    }
                }else{
                    this.query.column = column
                    this.query.direction=='desc'
                }
                this.fetchIndexData()
            },
            fetchIndexData(){
                var vm = this
                axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.column}&search_operator=${this.query.operator}&search_input=${this.query.input}`)
                    .then(function(response){
                        Vue.set(vm.$data, 'model', response.data.model)
                        Vue.set(vm.$data, 'columns', response.data.columns)
                    })
                    .catch(function (err) {
                        
                    })
            }
        }
    }
</script>
<template>
    <div class="dv">
        <div class="dv-header">
            <div class="dv-header-title">
                {{title}}
            </div>

            <div class="dv-header-columns">
                <span>Search:</span>
                <select class="dv-header-select" v-model="query.search_column">
                    <option v-for="column in columns" :value="column">{{column}}</option>
                </select>
            </div>

            <div class="dv-header-operators">
                <select class="dv-header-select" v-model="query.search_operator">
                    <option v-for="(value, key) in operators" :value="key">{{value}}</option>
                </select>
            </div>

            <div class="dv-header-search">
                <input type="text" class="dv-header-input " placeholder="Search" v-model="query.search_input">
            </div>

            <div class="dv-header-submit">
                <button class="dv-header-btn button secondary" @click="fetchIndexData()">Filter</button>
            </div>
        </div>

        <div>
            <table>
                <thead>
                <tr >
                   <th v-for="column in columns" @click="toggleOrder(column)">
                       {{column}}
                       <span v-if="column === query.column">
                        <span v-if="query.direction ==='asc'">&uarr;</span>
                       <span v-if="query.direction ==='desc'">&darr;</span>
                       </span>
                   </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in model.data">
                    <td v-for="(value, key) in row">{{value}}</td>
                </tr>

                </tbody>
            </table>
            <div class="table-footer">
                <span @click="prev()" class="paginate-btn">&laquo; Pervious</span>
                <span @click="next()" class="paginate-btn">Next &raquo;</span>
                <span>Displaying {{model.from}} - {{model.to}} from {{model.total}} rows.</span>
            </div>
            <div class="paginated">
                <el-pagination
                        background
                        layout="prev, pager, next"
                        :total="1000">
                </el-pagination>
            </div>
            <div class="per_page">
                    <div class="grid-x grid-padding-x">
                        <div class="small-8 cell">
                            <label for="middle-label" class="text-right middle">Number of Records to display</label>
                        </div>
                        <div class="small-4 cell">
                            <input type="text" id="middle-label" v-model="query.per_page" @keyup="fetchIndexData()">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>
<style></style>