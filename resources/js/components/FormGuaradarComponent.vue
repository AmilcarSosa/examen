<template>

</template>

<script>
    export default {
        name: "FormGuaradarComponent",
        data() {
            return {

            }
        },
        created() {
            axios.get(
                'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/2020-02-19/2020-02-19',
                {'headers': {'Bmx-Token': '0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5'}}
            )
                .then((res) => {
                    console.log(res);
                })
        },
        methods: {
            calcularPesos() {
            },

        }
    }
</script>

<style scoped>

</style>
