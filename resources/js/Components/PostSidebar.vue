<template>
    <div class="sticky top-[75px]">
        <div class="mb-5">
            <slot></slot>
        </div>
        <div>
            <h2 class="text-xl">
                Follow our activity
            </h2>
            <div>
                <form>
                    <input class="w-full border-slate-300" type="text" placeholder="johndoe@gmail.com">
                    <button class="w-1/3 mt-2 py-2 px-3 bg-white text-slate-800 border-2 border-pink-500 rounded" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>