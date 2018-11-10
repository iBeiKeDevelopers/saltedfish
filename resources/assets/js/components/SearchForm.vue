<template>
    <form id="form" class="navbar-form navbar-right
            form-inline
            hidden-xs
            main-gradient"
        role="search"
        method="GET"
        :action="url">
        <div class="form-group" style="width:80%;">
            <input type="text" class="form-control" name="keyword" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-search">搜索</button>
    </form>
</template>

<script>
export default {
    props: [
        'url',
    ],
    mounted() {
        //
    }
}
</script>

