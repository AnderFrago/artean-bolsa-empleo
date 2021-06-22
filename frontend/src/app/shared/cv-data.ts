import { Cv, WorkExperiences, Studies, Language, OtherKnowledge } from './cv';

export class CvData {
    
    static cvs: Cv[] = [
        {
            id: 1,
            works: [
                {
                    position: 'Desarrollador',
                    duties: 'Mantenimiento aplicación comercial',
                    employer: 'Cuatrovientos ITC',
                    location: 'Pamplona/Iruña',
                    startDate: new Date("2020-01-01"),
                    endDate: new Date("2020-01-01"),
                }
            ],
            studies: [
                {
                    title: "Desarrollo de Aplicaciones Multiplataforma",
                    category: "Informática",
                    level: "Formación Profesional Ciclo superior",
                    description: "Desarrollo de aplicaciones",
                    center: "Cuatrovientos ITC",
                    startDate: new Date("2020-01-01"),
                    endDate: new Date("2020-01-01"),
                }
            ],
            languages: [
                {
                    name: "Euskera",
                }
            ]
        }


    ];
}