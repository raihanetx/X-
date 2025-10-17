<div v-if="currentView === 'refundPolicy'" class="bg-white min-h-screen">
    <div class="container mx-auto max-w-4xl p-6 md:p-12">
        <div class="space-y-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 text-center border-b pb-4">Refund Policy</h1>
            <div class="text-gray-700 leading-relaxed" v-html="formattedPageContent"></div>
        </div>
    </div>
</div>