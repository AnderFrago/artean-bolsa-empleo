export interface Offer {
    id: number,
    company: string,
    dueDate: Date,
    position: String,
    requirements?: Requirements,
    description: Description,
    numberOfApplyments: number

}
export interface Description {
    text: string,
}
export interface Requirements {
    minimumRequirements: string
}


