<script>
    module.exports = {
        props: [],
        data: function () {
            return {
                submitted: false
            }
        },
        methods: {
            disableButton: function () {
                this.submitted = true;
            }
        }
    }
</script>