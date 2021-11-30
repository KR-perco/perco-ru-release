(() => {
    window.addEventListener('load', () => {
        const kronshteiny = [{
                name: 'Кронштейн MK-BH02 2-22',
                image: 'MK-BH02_2_22.jpg',
                imagePreview: 'MK-BH02_2_22-preview.png',
                categories: [
                    ['Ограждение BH02', 'Контроллер PERCo-CL15'],
                ],
                price: 60
            },
            {
                name: 'Стойка BH02 0-05',
                image: 'BH02_0_05.jpg',
                imagePreview: 'BH02_0_05-preview.png',
                categories: [
                    ['Ограждение BH02', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Ограждение BH02', 'Терминал распознавания лиц Suprema-FaceLite'],
                ],
                price: 107
            },
            {
                name: 'Стойка BH02 0-06',
                image: 'BH02_0_06.png',
                imagePreview: 'BH02_0_06-preview.png',
                categories: [
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Ограждение BH02', 'Алкотестер Алкобарьер'],
                    ['Ограждение BH02', 'Алкотестер Динго В-02'],
                    //['Ограждение BH02', 'Другое оборудование (вертикальная. площадка)'],
                ],
                price: 112
            },
            {
                name: 'Крышка С-10F',
                image: 'C-10F.jpg',
                imagePreview: 'C-10F-preview.png',
                categories: [
                    ['Тумбовый турникет TTD-10A', 'Контроллер Suprema BioEntry W2 (P2)'],
                    ['Тумбовый турникет TTD-10A', 'Контроллер PERCo-CL15'],
                ],
                price: 45
            },
            {
                name: 'Крышка C-10P.1',
                image: 'C-10P.1.jpg',
                imagePreview: 'C-10P.1-preview.png',
                categories: [
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц Suprema-FaceLite'],
                ],
                price: 129
            },
            {
                name: 'Крышка C-10P.2',
                image: 'C-10P.2.jpg',
                imagePreview: 'C-10P.2-preview.png',
                categories: [
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовый турникет TTD-10A', 'Алкотестер Алкобарьер'],
                    ['Тумбовый турникет TTD-10A', 'Алкотестер Динго В-02'],
                ],
                price: 126
            },
            {
                name: 'Стойка C-11P.1',
                image: 'C-11P.1.jpg',
                imagePreview: 'C-11P.1-preview.png',
                categories: [
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц Suprema-FaceLite'],
                ],
                price: 47
            },
            {
                name: 'Стойка C-11P.2',
                image: 'C-11P.2.jpg',
                imagePreview: 'C-11P.2-preview.png',
                categories: [
                    // ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7A'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-ProFaceX', 1],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Турникет-трипод TTR-11A', 'Алкотестер Алкобарьер'],
                    ['Турникет-трипод TTR-11A', 'Алкотестер Динго В-02'],
                    //['Турникет-трипод TTR-11A', 'Другое оборудование (вертикальная. площадка)'],
                ],
                price: 80
            },
            {
                name: 'Комплект кронштейнов BS1',
                image: 'BS1.jpg',
                imagePreview: 'BS1-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Контроллер Suprema BioEntry W2 (P2)']
                ],
                price: 67
            },
            {
                name: 'Комплект кронштейнов BS2',
                image: 'BS2.jpg',
                imagePreview: 'BS2-preview.png',
                categories: [
                    ['Тумбовый турникет TTD-03.1', 'Контроллер Suprema BioEntry W2 (P2)']
                ],
                price: 49
            },
            {
                name: 'Комплект кронштейнов BS5',
                image: 'BS5.jpg',
                imagePreview: 'BS5-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Контроллер PERCo-CL15']
                ],
                price: 78
            },
            {
                name: 'Стойка BSP1',
                image: 'BSP1.jpg',
                imagePreview: 'BSP1-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-Face-Station2', 2],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-FaceLite', 1],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц Suprema-FaceLite'],
                ],
                price: 60
            },
            {
                name: 'Стойка BSP2',
                image: 'BSP2.jpg',
                imagePreview: 'BSP2-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-ProFaceX', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5', 1],
                    ['Скоростной проход ST-01', 'Алкотестер Алкобарьер', 1],
                    ['Скоростной проход ST-01', 'Алкотестер Динго В-02', 1],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовый турникет TTD-03.2', 'Алкотестер Алкобарьер'],
                    ['Тумбовый турникет TTD-03.2', 'Алкотестер Динго В-02'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Алкотестер Алкобарьер'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Алкотестер Динго В-02'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовый турникет TTD-08A', 'Алкотестер Алкобарьер'],
                    ['Тумбовый турникет TTD-08A', 'Алкотестер Динго В-02'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Алкотестер Алкобарьер'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Алкотестер Динго В-02'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Алкотестер Алкобарьер'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Алкотестер Динго В-02'],
                ],
                price: 119
            },
            {
                name: 'Передняя панель FP-01P.1',
                image: 'FP-01P1.jpg',
                imagePreview: 'FP-01P1-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-Face-Station2', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-FaceLite', 2]
                ],
                price: 352
            },
            {
                name: 'Передняя панель FP-01P.2',
                image: 'FP-01P2.jpg',
                imagePreview: 'FP-01P2-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B', 2],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-ProFaceX', 2],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5', 2],
                    ['Скоростной проход ST-01', 'Алкотестер Алкобарьер', 2],
                    ['Скоростной проход ST-01', 'Алкотестер Динго В-02', 2],
                ],
                price: 377
            },
            {
                name: 'Кронштейн BS7B',
                image: 'BS7B.jpg',
                imagePreview: 'BS7B-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B', 2],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц ZKTeco-FaceDepot-7B'],
                ],
                price: 60
            },
            {
                name: 'Кронштейн BS8',
                image: 'BS8.jpg',
                imagePreview: 'BS8-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-ProFaceX', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-ProFaceX', 2],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-ProFaceX', 1],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц ZKTeco-ProFaceX'],
                ],
                price: 92
            },
            {
                name: 'Кронштейн BS9',
                image: 'BS9.jpg',
                imagePreview: 'BS9-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5', 2],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Ограждение BH02', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц ZKTeco-SpeedFace-V5'],
                ],
                price: 92
            },
            {
                name: 'Кронштейн BS10',
                image: 'BS10.jpg',
                imagePreview: 'BS10-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-Face-Station2', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-Face-Station2', 2],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Ограждение BH02', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц Suprema-Face-Station2'],
                ],
                price: 84
            },
            {
                name: 'Кронштейн BS11',
                image: 'BS11.jpg',
                imagePreview: 'BS11-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-FaceLite', 1],
                    ['Скоростной проход ST-01', 'Терминал распознавания лиц Suprema-FaceLite', 2],
                    ['Тумбовый турникет TTD-03.2', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Ограждение BH02', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Тумбовый турникет TTD-10A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Турникет-трипод TTR-11A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Тумбовый турникет TTD-08A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Терминал распознавания лиц Suprema-FaceLite'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Терминал распознавания лиц Suprema-FaceLite'],
                    //['Электронная проходная KTC01.9A', 'Терминал распознавания лиц Suprema-FaceLite'],
                ],
                price: 84
            },
            {
                name: 'Кронштейн BS12',
                image: 'BS12.jpg',
                imagePreview: 'BS12-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Алкотестер Алкобарьер', 1],
                    ['Скоростной проход ST-01', 'Алкотестер Алкобарьер', 2],
                    ['Тумбовый турникет TTD-03.2', 'Алкотестер Алкобарьер'],
                    ['Ограждение BH02', 'Алкотестер Алкобарьер'],
                    ['Тумбовый турникет TTD-10A', 'Алкотестер Алкобарьер'],
                    ['Турникет-трипод TTR-11A', 'Алкотестер Алкобарьер'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Алкотестер Алкобарьер'],
                    ['Тумбовый турникет TTD-08A', 'Алкотестер Алкобарьер'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Алкотестер Алкобарьер'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Алкотестер Алкобарьер'],
                    //['Электронная проходная KTC01.9A', 'Алкотестер Алкобарьер'],
                ],
                price: 74
            },
            {
                name: 'Кронштейн BS13',
                image: 'BS13.jpg',
                imagePreview: 'BS13-preview.png',
                categories: [
                    ['Скоростной проход ST-01', 'Алкотестер Динго В-02', 1],
                    ['Скоростной проход ST-01', 'Алкотестер Динго В-02', 2],
                    ['Тумбовый турникет TTD-03.2', 'Алкотестер Динго В-02'],
                    ['Ограждение BH02', 'Алкотестер Динго В-02'],
                    ['Тумбовый турникет TTD-10A', 'Алкотестер Динго В-02'],
                    ['Турникет-трипод TTR-11A', 'Алкотестер Динго В-02'],
                    ['Тумбовые турникеты TB01A, TBC01A', 'Алкотестер Динго В-02'],
                    ['Тумбовый турникет TTD-08A', 'Алкотестер Динго В-02'],
                    ['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Алкотестер Динго В-02'],
                    ['Электронная проходная KT05.9A, KTC01.9A', 'Алкотестер Динго В-02'],
                ],
                price: 74
            },
            {
                name: 'Кронштейн BS14',
                image: 'BS14.jpg',
                imagePreview: 'BS14-preview.png',
                categories: [
                    //['Скоростной проход ST-01', 'Другое оборудование (вертикальная. площадка)', 1],
                    //['Скоростной проход ST-01', 'Другое оборудование (вертикальная. площадка)', 2],
                    //['Тумбовый турникет TTD-03.2', 'Другое оборудование (вертикальная. площадка)'],
                    //['Ограждение BH02', 'Другое оборудование (вертикальная. площадка)'],
                    //['Тумбовый турникет TTD-10A', 'Другое оборудование (вертикальная. площадка)'],
                    //['Турникет-трипод TTR-11A', 'Другое оборудование (вертикальная. площадка)'],
                    //['Тумбовые турникеты TB01A, TBC01A', 'Другое оборудование (вертикальная. площадка)'],
                    //['Тумбовый турникет TTD-08A', 'Другое оборудование (вертикальная. площадка)'],
                    //['Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q', 'Другое оборудование (вертикальная. площадка)'],
                    //['Электронная проходная KT05.9A, KTC01.9A', 'Другое оборудование (вертикальная. площадка)'],
                    //['Электронная проходная KTC01.9A', 'Другое оборудование (вертикальная. площадка)'],
                ],
                price: 72
            },
        ];
        const combinations = {
            'Скоростной проход ST-01': {
                'Контроллер PERCo-CL15': [{
                    name: 'Решение для установки контроллера PERCo-CL15 на скоростной проход ST-01',
                    image: 'cl15-st-01.jpg',
                    imagePreview: 'cl15-st-01-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на скоростной проход ST-01',
                        image: 'ST01-ZKTeco-FaceDepot-7B.jpg',
                        imagePreview: 'ST01-ZKTeco-FaceDepot-7B-preview.png'
                    },
                    {
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на скоростной проход ST-01',
                        image: 'ST01-ZKTeco-FaceDepot-7B-2.jpg',
                        imagePreview: 'ST01-ZKTeco-FaceDepot-7B-2-preview.png'
                    },
                ],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на скоростной проход ST-01',
                        image: 'ST01-ZKTeco-ProFace-X.jpg',
                        imagePreview: 'ST01-ZKTeco-ProFace-X-preview.png'
                    },
                    {
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на скоростной проход ST-01',
                        image: 'ST01-ZKTeco-ProFace-X-2.jpg',
                        imagePreview: 'ST01-ZKTeco-ProFace-X-2-preview.png'
                    }
                ],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                        name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на скоростной проход ST-01',
                        image: 'ST01-suprema-face-station-2.jpg',
                        imagePreview: 'suprema-face-station-2-ST01-preview.png'
                    },
                    {
                        name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на скоростной проход ST-01',
                        image: 'ST01-Suprema-Face-Station-2-2.jpg',
                        imagePreview: 'ST01-Suprema-Face-Station-2-2-preview.png'
                    }
                ],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                        name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на скоростной проход ST-01',
                        image: 'ST01-Suprema-FACELite-2.jpg',
                        imagePreview: 'ST01-Suprema-FACELite-preview.png'
                    },
                    {
                        name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на скоростной проход ST-01',
                        image: 'ST01-Suprema-FACELite-2-2var.jpg',
                        imagePreview: 'ST01-Suprema-FACELite-2-preview.png'
                    }
                ],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на скоростной проход ST-01',
                        image: 'zkteco-speedface-v5.jpg',
                        imagePreview: 'zkteco-speedface-v5-preview.png'
                    },
                    {
                        name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на скоростной проход ST-01',
                        image: 'ST01-ZKTeco-SpeedFace-2.jpg',
                        imagePreview: 'ST01-ZKTeco-SpeedFace-V5L-2-preview.png'
                    }
                ],
                'Алкотестер Алкобарьер': [{
                        name: 'Решение для установки алекотестера Алкобарьер на скоростной проход ST-01',
                        image: 'ST01-alkkobarier.jpg',
                        imagePreview: 'ST01-alkobarier-preview.png'
                    },
                    {
                        name: 'Решение для установки алекотестера Алкобарьер на скоростной проход ST-01',
                        image: 'ST01-alkobarier-2.jpg',
                        imagePreview: 'ST01-alkobarier-2-preview.png'
                    }
                ],
                'Алкотестер Динго В-02': [{
                        name: 'Решение для установки алекотестера Динго В-02 на скоростной проход ST-01',
                        image: 'ST01-dingo.jpg',
                        imagePreview: 'ST01-dingo-preview.png'
                    },
                    {
                        name: 'Решение для установки алекотестера Динго В-02 на скоростной проход ST-01',
                        image: 'ST01-dingo-2.jpg',
                        imagePreview: 'ST01-dingo-2-preview.png'
                    }
                ]
            },
            'Тумбовый турникет TTD-03.2': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на тумбовый турникет TTD-03.2',
                    image: 'TTD03-KT02-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TTD03-KT02-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовый турникет TTD-03.2',
                    image: 'TTD03-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TTD03-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовый турникет TTD-03.2',
                    image: 'TTD03-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TTD03-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на тумбовый турникет TTD-03.2',
                    image: 'TTD03-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TTD03-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на тумбовый турникет TTD-03.2',
                    image: 'TTD03-ZKTeco-Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TTD03-ZKTeco-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на тумбовый турникет TTD-03.2',
                    image: 'TTD03-Suprema-FACELite.jpg',
                    imagePreview: 'TTD03-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алекотестера Алкобарьер на тумбовый турникет TTD-03.2',
                    image: 'TTD03-alkobarier.jpg',
                    imagePreview: 'TTD03-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алекотестера Динго В-02 на тумбовый турникет TTD-03.2',
                    image: 'TTD03-dingo.jpg',
                    imagePreview: 'TTD03-dingo-preview.png'
                }]
            },
            'Ограждение BH02': {
                'Контроллер PERCo-CL15': [{
                    name: 'Решение для установки контроллера PERCo-CL15 на ограждение BH02',
                    image: 'cl15-bh02.jpg',
                    imagePreview: 'cl15-bh02-preview.png'
                }]
            },
            'Тумбовый турникет TTD-10A': {
                'Контроллер Suprema BioEntry W2 (P2)': [{
                    name: 'Решение для установки контроллера Suprema BioEntry W2 (P2) на тумбовый турникет TTD-10A',
                    image: 'suprema-bioentry-w2-ttd-10.jpg',
                    imagePreview: 'suprema-bioentry-w2-ttd-10-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на тумбовый турникет TTD-10A',
                    image: 'TTD-10-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TTD-10-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовый турникет TTD-10A',
                    image: 'TTD-10-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TTD-10-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на тумбовый турникет TTD-10A',
                    image: 'TTD-10-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TTD-10-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на тумбовый турникет TTD-10A',
                    image: 'TTD-10--Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TTD-10-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на тумбовый турникет TTD-10A',
                    image: 'TTD-10--Suprema-FACELite.jpg',
                    imagePreview: 'TTD-10-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на тумбовый турникет TTD-10A',
                    image: 'alkobarier-ttd-10a.jpg',
                    imagePreview: 'alkobarier-ttd-10a-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на тумбовый турникет TTD-10A',
                    image: 'dingo-TTD-10.jpg',
                    imagePreview: 'dingo-TTD-10-preview.png'
                }]
            },
            'Турникет-трипод TTR-11A': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на турникет-трипод TTR-11A',
                    image: 'TTR-11-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TTR-11-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на турникет-трипод TTR-11A',
                    image: 'zkteco-profacex-ttr-11.jpg',
                    imagePreview: 'zkteco-profacex-ttr-11-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на турникет-трипод TTR-11A',
                    image: 'TTR-11-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TTR-11-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на турникет-трипод TTR-11A',
                    image: 'TTR-11-Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TTR-11-ZKTeco-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на турникет-трипод TTR-11A',
                    image: 'TTR-11-Suprema-FACELite.jpg',
                    imagePreview: 'TTR-11-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на турникет-трипод TTR-11A',
                    image: 'TTR-11-alkobarier.jpg',
                    imagePreview: 'TTR-11-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на турникет-трипод TTR-11A',
                    image: 'TTR-11-dingo.jpg',
                    imagePreview: 'TTR-11-dingo-preview.png'
                }]
            },
            'Тумбовые турникеты TB01A, TBC01A': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TB01-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TB01-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TB01-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TB01-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-Suprema-FACELite.jpg',
                    imagePreview: 'TB01-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-alkobarier.jpg',
                    imagePreview: 'TB01-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на тумбовые турникеты TB01A, TBC01A',
                    image: 'TB01-dingo.jpg',
                    imagePreview: 'TB01-dingo-preview.png'
                }]
            },
            'Тумбовый турникет TTD-08A': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на тумбовый турникет TTD-08A',
                    image: 'TTD08-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TTD08-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовый турникет TTD-08A',
                    image: 'TTD08-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TTD08-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на тумбовый турникет TTD-08A',
                    image: 'TTD08-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TTD08-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на тумбовый турникет TTD-08A',
                    image: 'TTD08-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TTD08-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на тумбовый турникет TTD-08A',
                    image: 'TTD08--Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TTD08-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на тумбовый турникет TTD-08A',
                    image: 'TTD08--Suprema-FACELite.jpg',
                    imagePreview: 'TTD08-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на тумбовый турникет TTD-08A',
                    image: 'TTD08-alkobarier.jpg',
                    imagePreview: 'TTD08-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на тумбовый турникет TTD-08A',
                    image: 'TTD08-dingo.jpg',
                    imagePreview: 'TTD08-dingo-preview.png'
                }]
            },
            'Электронная проходная KT02.3, KT02.9, KT02.9B, KT02.9Q': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'KT02-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'KT02-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'KT02-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02 ZKTeco-Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'KT02-ZKTeco-Suprema-Face-Station-2-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02 Suprema-FACELite.jpg',
                    imagePreview: 'KT02-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02-alkobarier.jpg',
                    imagePreview: 'KT02-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на электронные проходные KT02.3, KT02.9, KT02.9B, KT02.9Q',
                    image: 'KT02-dingo.jpg',
                    imagePreview: 'KT02-dingo-preview.png'
                }]
            },
            'Электронная проходная KT05.9A, KTC01.9A': {
                'Терминал распознавания лиц ZKTeco-FaceDepot-7B': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-FaceDepot-7B на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-ZKTeco-FaceDepot-7B.jpg',
                    imagePreview: 'TB01-ZKTeco-FaceDepot-7B-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-ProFaceX': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-ProFaceX на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-ZKTeco-ProFace-X.jpg',
                    imagePreview: 'TB01-ZKTeco-ProFace-X-preview.png'
                }],
                'Терминал распознавания лиц ZKTeco-SpeedFace-V5': [{
                    name: 'Решение для установки терминала распознавания лиц ZKTeco-SpeedFace-V5 на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-ZKTeco-SpeedFace-V5.jpg',
                    imagePreview: 'TB01-ZKTeco-SpeedFace-V5-preview.png'
                }],
                'Терминал распознавания лиц Suprema-Face-Station2': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-Face-Station2 на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-Suprema-Face-Station-2-2.jpg',
                    imagePreview: 'TB01-Suprema-Face-Station-2-preview.png'
                }],
                'Терминал распознавания лиц Suprema-FaceLite': [{
                    name: 'Решение для установки терминала распознавания лиц Suprema-FaceLite на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-Suprema-FACELite.jpg',
                    imagePreview: 'TB01-Suprema-FACELite-preview.png'
                }],
                'Алкотестер Алкобарьер': [{
                    name: 'Решение для установки алкотестера Алкобарьер на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-alkobarier.jpg',
                    imagePreview: 'TB01-alkobarier-preview.png'
                }],
                'Алкотестер Динго В-02': [{
                    name: 'Решение для установки алкотестера Динго В-02 на электронные проходные KT05.9A, KTC01.9A',
                    image: 'TB01-dingo.jpg',
                    imagePreview: 'TB01-dingo-preview.png'
                }]
            }
        };
        const kronshteinyTree = {};
        document.querySelector('.select-kronshtein__turniket').addEventListener('change', function() {
            const selectKronshtein = document.querySelector('.select-kronshtein__kronshtein');
            document.querySelector('.kronshteiny').innerHTML = '';
            selectKronshtein.innerHTML = '<option>Выбрать</option>';
            for (key in kronshteinyTree[document.querySelector('.select-kronshtein__turniket').value]) {
                selectKronshtein.innerHTML += `<option>${key}</option>`;
            }
            document.querySelector('.select-kronshtein__kronshtein').style.display = 'block';
        });
        document.querySelector('.select-kronshtein__kronshtein').addEventListener('change', () => {
            document.querySelector('.kronshteiny').innerHTML = '';
            const turniket = document.querySelector('.select-kronshtein__turniket').value;
            const terminal = document.querySelector('.select-kronshtein__kronshtein').value;
            const options = kronshteinyTree[turniket][terminal];
            let result = '';
            if (options.length < 2) {
                result = `<div class="kronshteiny-options">`;
                result += `<div class="kronshteiny-option">`;
                if (combinations[turniket]) {
                    if (combinations[turniket][terminal]) {
                        if (combinations[turniket][terminal][0] && combinations[turniket][terminal][0] !== []) {
                            result += `<div class="secel_item test1" style="margin-inline-end: 32px;">
								<a href="/images/products/kronshteiny/${combinations[turniket][terminal][0].image}">
									<div class="image_icon">
										<img alt="${combinations[turniket][terminal][0].name}" src="/images/products/kronshteiny/${combinations[turniket][terminal][0].imagePreview}">
									</div>
									<div class="text_item">
										<span>${combinations[turniket][terminal][0].name}</span>
									</div>
								</a>
							</div>`;
                        }
                    }
                }
                options[0].forEach(kronshtein => {
                    result += `<div class="secel_item test1">
						<a href="/images/products/kronshteiny/${kronshtein.image}">
							<div class="image_icon">
								<img alt="${kronshtein.name}" src="/images/products/kronshteiny/${kronshtein.imagePreview}">
							</div>
							<div class="text_item">
								<span>${kronshtein.name}</span>
								<div class="price">
									<p style="">Цена <span class="price_rub">${kronshtein.priceRubles} ₽</span> со склада в Москве и Санкт-Петербурге</p>
									<p>${kronshtein.price} € (по курсу ЦБ РФ на ${window.date})</p>
								</div>
							</div>
						</a>
					</div>`;
                    console.log(kronshtein);
                });
                result += `</div>`;
                result += `</div>`;
            } else {
                result = `<div class="kronshteiny-options">`;
                options.forEach((option, index) => {
                    result += `<div class="kronshteiny-option">`;
                    result += `<div class="kronshteiny-option-name">Вариант ${index + 1}</div>`;
                    if (combinations[turniket]) {
                        if (combinations[turniket][terminal]) {
                            if (combinations[turniket][terminal][index] && combinations[turniket][terminal][index] !== []) {
                                result += `<div class="secel_item test1" style="margin-inline-end: 32px;">
									<a href="/images/products/kronshteiny/${combinations[turniket][terminal][index].image}">
										<div class="image_icon">
											<img alt="${combinations[turniket][terminal][index].name}" src="/images/products/kronshteiny/${combinations[turniket][terminal][index].imagePreview}">
										</div>
										<div class="text_item">
											<span>${combinations[turniket][terminal][index].name}</span>
										</div>
									</a>
								</div>`;
                            }
                        }
                    }
                    option.forEach(kronshtein => {
                        result += `<div class="secel_item test1">
							<a href="/images/products/kronshteiny/${kronshtein.image}">
								<div class="image_icon">
									<img alt="${kronshtein.name}" src="/images/products/kronshteiny/${kronshtein.imagePreview}">
								</div>
								<div class="text_item">
									<span>${kronshtein.name}</span>
									<div class="price">
										<p style="">Цена <span class="price_rub">${kronshtein.priceRubles} ₽</span> со склада в Москве и Санкт-Петербурге</p>
										<p>${kronshtein.price} € (по курсу ЦБ РФ на ${window.date})</p>
									</div>
								</div>
							</a>
						</div>`;
                    });
                    result += `</div>`;
                });
                result += `</div>`;
            }
            document.querySelector('.kronshteiny').innerHTML = result;
            if ($(".kronshteiny").data('lightGallery')) {
                $(".kronshteiny").data('lightGallery').destroy(true);
            }
            $('.kronshteiny').lightGallery({
                selector: 'a'
            });
        });
        kronshteiny.forEach(kronshtein => {
            kronshtein.categories.forEach(category => {
                kronshtein.priceRubles = window.euro * kronshtein.price;
                if (!kronshteinyTree[category[0]]) {
                    kronshteinyTree[category[0]] = {};
                }
                if (!kronshteinyTree[category[0]][category[1]]) {
                    kronshteinyTree[category[0]][category[1]] = [];
                }
                if (!kronshteinyTree[category[0]][category[1]][0]) {
                    kronshteinyTree[category[0]][category[1]][0] = [];
                }
                if (!category[2]) {
                    kronshteinyTree[category[0]][category[1]][0].push(kronshtein);
                } else {
                    if (!kronshteinyTree[category[0]][category[1]][category[2] - 1]) {
                        kronshteinyTree[category[0]][category[1]][category[2] - 1] = [];
                    }
                    kronshteinyTree[category[0]][category[1]][category[2] - 1].push(kronshtein);
                }
            });
        });
        console.log(kronshteinyTree);
        console.log(window);
    });
})();