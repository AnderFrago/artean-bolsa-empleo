export interface Offer {
    id: number,
    name: string,
    dueDate: Date,    
    requirements?: Requirements,
    description: Description,
    numberOfApplyments: number

}
export interface Description {
    text: string,
    typeOfIndustry?: string,
    category: string,
    level: string,
    staffInCharge?: string
    numberOfVacancies?: number,
    schedule?: string,
    salary?: number,
    perks?: string
}
export interface Requirements {
    minimumEducation?: string,
    minimumWorkExperience?: string,
    minimumRequirements: string
}


