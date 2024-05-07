<script>

import axios from "axios";


export default{
    data(){
        return {
            students : []
        }
    },

    mounted(){
        this.getCategories();
    },

    methods: {

        getCategories(){
            axios.get('http://localhost:8000/api/all-category').then(response=>{
                console.log(response.data)
            });

        }
    }
}


</script>


<template>
    <h1>Shuvo</h1>
</template>