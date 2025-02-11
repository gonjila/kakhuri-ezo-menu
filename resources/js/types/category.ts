import {IProduct} from "@/types/product";

export interface ICategory {
    id: string,
    title: string;
    image:string;
    created_at: string;
    updated_at: string;
    products: IProduct[];
}
