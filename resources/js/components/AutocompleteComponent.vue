<template>
    <div>
        <input
                type="text"
                placeholder="what are you looking for?"
                v-model="query"
                v-on:keyup="autoComplete"
                class="form-control"
                name="regionId"
                value=""
        >
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group">
                <li class="list-group-item" v-for="result in results" v-on:click="selectRegion(result)">

                    {{ result.name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                query: '',
                results: [],

            }
        },
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 1){
                    axios.get('/search',{params: {query: this.query}}).then(response => {
                        console.log(response.data);

                        this.results = response.data;
                    });
                }
            },
            selectRegion(result){

                let inputWithRegions = document.querySelector('.form-control');
                let listRegions = document.querySelector('.panel-footer');



                document.addEventListener('click', function(event) {
                    let isClickInside = listRegions.contains(event.target);

                    if (!isClickInside) {
                        console.log(11);
                        inputWithRegions.name = 2222;
                        inputWithRegions.value = 1111;
                    }

                    console.log(22);
                    inputWithRegions.name = result.id;
                    inputWithRegions.value = result.name;

                    listRegions.hidden = true;
                });





            }
        }
    }
</script>

<style scoped>

</style>