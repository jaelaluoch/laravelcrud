<template>
    <div>

            <Nav v-if="!$route.meta.hideNavigation"></Nav>
            <NoNav v-if="$route.meta.hideNavigation"></NoNav>

    </div>
</template>
<script>
import Nav from './Nav'
import NoNav from './NoNav'

export default {
    name: 'App',
    components: {
        Nav,
        NoNav
    }
}
</script>
