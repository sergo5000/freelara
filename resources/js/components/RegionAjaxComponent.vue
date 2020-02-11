<template>

</template>

<script>
    export default {
        props: [
            'regions'
        ],
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                console.log(this.regions)
            }
        }
    }
</script>