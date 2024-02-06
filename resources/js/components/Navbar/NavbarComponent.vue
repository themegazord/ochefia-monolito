<script setup>
    const props = defineProps({
        links: {
            type: Array,
            required: true
        }
    })
</script>

<template>
    <nav class="navbar">
        <div class="container-logo">
            <img src="../../../images/logo.png" alt="Logo do O Chefia" class="logo">
        </div>
        <div class="container-links">
            <a :href="link?.url" class="link" v-for="(link, index) in links" :key="index">{{ link?.nome }}</a>
        </div>
    </nav>
</template>

<style scoped>
@media (max-width: 2560px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 2560) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 2560) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 2560) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 2560) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1920px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1920) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1920) / 1920);
    }

    .container-links {
        display: flex;
        gap: 1rem;
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: 1.3rem;

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1600px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1600) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1600) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 1600) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 1600) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1440px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1440) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1440) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 1440) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 1440) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1366px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1366) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1366) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 1366) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 1366) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1280px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1280) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1280) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 1280) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 1280) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
@media (max-width: 1024px) {
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 10vh;
        background: var(--platinum);
    }
    .container-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: calc((2rem * 1024) / 1920);
        height: 100%;
    }

    .logo {
        max-height: 100%;
        height: calc((4rem * 1024) / 1920);
    }

    .container-links {
        display: flex;
        gap: calc((1rem * 1024) / 1920);
        align-items: center;
        width: 30%;
    }

    .link {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--steel-blue);
        font-size: calc((1.3rem * 1024) / 1920);

        transition: all .5s ease-in-out;
    }

    .link:hover {
        color: var(--dodger-blue);
    }
}
</style>
