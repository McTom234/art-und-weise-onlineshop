// noinspection ES6ConvertVarToLetConst

import { Alpine as AlpineType } from "alpinejs";
import { Axios as AxiosType } from "axios";
import { Lodash as LodashType } from "lodash"

declare global {
    var Alpine: AlpineType
    var axios: AxiosType
    var _: LodashType
    var privacy: Privacy
}
