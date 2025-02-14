<template>
    <v-container class="my-[20px]">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/privacy_banner.jpg" alt=""
                    class="img-fluid object-cover w-100 !h-[400px] rounded-[15px]" />
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <v-breadcrumbs :items="items" class="px-0 mb-0 text-[17px]">
                    <template v-slot:divider>
                        <BreadcrumbIcon />
                    </template>
                </v-breadcrumbs>
            </div>
        </div>

        <section>
            <v-row class="mb-3">
                <v-col cols="12" md="6" lg="8">
                    <h1 class="font-bold text-gray-800">{{ __('privacy.title') }}</h1>
                    <p class="m-0 text-gray-700 text-md">{{ __('privacy.subtitle') }}</p>
                </v-col>
            </v-row>
            <v-row>
                <ThePrivacyCard v-for="policy in policies" :key="policy.id" :title="policy.title"
                    :description="policy.description" />
            </v-row>
        </section>
    </v-container>
</template>

<script setup>
import { __ } from "matice";
import BreadcrumbIcon from "../Components/icons/BreadcrumbIcon.vue";
import ThePrivacyCard from "../Components/ThePrivacyCard.vue";

const items = [
    {
        title: __("home"),
        disabled: false,
        href: route("index"),
    },
    {
        title: __("privacy.title"),
        disabled: true,
        href: route("privacy"),
    },
];

const policies = [
    {
        id: 1,
        title: "Log Data",
        description: "We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (“IP”) address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics."

    },
    {
        id: 2,
        title: "Cookies",
        description: "Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device's internal memory.\n This Service does not use these “cookies” explicitly. However, the app may use third party code and libraries that use “cookies” to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.",
    },
    {
        id: 3,
        title: 'Service Providers',
        description: "We may employ third-party companies and individuals due to the following reasons: \nTo facilitate our Service; \nTo provide the Service on our behalf; \nTo perform Service-related services; or \nTo assist us in analyzing how our Service is used.\nWe want to inform users of this Service that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose."
    },
    {
        id: 4,
        title: 'Security',
        description: 'We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.'
    },
    {
        id: 5,
        title: 'Children’s Privacy',
        description: 'These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.'
    },
    {
        id: 6,
        title: 'Changes to This Privacy Policy',
        description: 'We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately after they are posted on this page.'
    }
]

</script>
