using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace hfstk4
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            int zijde1 = Convert.ToInt32(Zijde1.Text);
            int zijde2 = Convert.ToInt32(Zijde2.Text);
            int zijde3 = Convert.ToInt32(Zijde3.Text);
            int volume = zijde1 * zijde2 * zijde3;
            VolumeLabel.Content = volume;
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            double radius = Convert.ToDouble(StraalText.Text);
            double circumference = 2 * Math.PI * radius;
            double area = Math.PI * Math.Pow(radius, 2);
            double volume = (4 * Math.PI / 3) * Math.Pow(radius, 3);
            StraalLabel1.Content = circumference;
            StraalLabel2.Content = area;
            StraalLabel3.Content = volume;
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            int outcomeStudent1 = 44;
            int outcomeStudent2 = 51;
            double average = (outcomeStudent1 + outcomeStudent2) / 2;
            AverageLabel.Content = average;

        }

        private void Button_Click_3(object sender, RoutedEventArgs e)
        {
            double inkomen = Convert.ToInt32(InkomenText.Text);
            double inkomstenBelasting = inkomen * 0.2;
            double newInkomen = inkomen * 0.8;
            inkomstenBelasting = (double)System.Math.Round(inkomstenBelasting, 2);
            newInkomen = (double)System.Math.Round(newInkomen, 2); 
            BelastingLabel.Content = inkomstenBelasting;
            NieuwInkomenLabel.Content = newInkomen;
        }

        private void Button_Click_4(object sender, RoutedEventArgs e)
        {
            double farenheit = 78;
            double celsius = (farenheit - 32) * 5 / 9;
            FarenheitLabel.Content = farenheit;
            CelsiusLabel.Content = celsius;

        }

        private void Button_Click_5(object sender, RoutedEventArgs e)
        {
            int totalNumberOfSeconds = 2549;
            double H = totalNumberOfSeconds / 3600;
            double M = totalNumberOfSeconds / 60;
            double S = (totalNumberOfSeconds - (M * 60)) / 1;
            double newH = Math.Floor(H);
            double newM = Math.Floor(M);
            double newS = Math.Floor(S);
            HLabel.Content = "H:"+newH;
            MLabel.Content = "M:"+newM;
            SLabel.Content = "S:"+newS;

            
        }

        private void Button_Click_6(object sender, RoutedEventArgs e)
        {
            double r1 = 4.7;
            double r2 = 6.8;
            double series = r1 + r2;
            double parallel = (r1 * r2) / (r1 + r2);
            SeriesLabel.Content = series;
            ParallelLabel.Content = parallel;
        }

        private void Button_Click_7(object sender, RoutedEventArgs e)
        {
            int Ingooi = Convert.ToInt32(IngooiBedrag.Text);
            int Kosten = Convert.ToInt32(DrankjeBedrag.Text);
            int Wisselgeld = Ingooi - Kosten;

            int coin200 = Wisselgeld / 200;
            Wisselgeld = Wisselgeld % 200;
            int coin100 = Wisselgeld / 100;
            Wisselgeld = Wisselgeld % 100;
            int coin50 = Wisselgeld / 50;
            Wisselgeld = Wisselgeld % 50;
            int coin20 = Wisselgeld / 20;
            Wisselgeld = Wisselgeld % 20;
            int coin10 = Wisselgeld / 10;
            Wisselgeld = Wisselgeld % 10;
            int coin5 = Wisselgeld / 5;
            Wisselgeld = Wisselgeld % 5;

            coin200Label.Content = "Number of 2 euro coins is: " + coin200;
            coin100Label.Content = "Number of 1 euro coins is: " + coin100;
            coin50Label.Content = "Number of 50 cent coins is: " + coin50;
            coin20Label.Content = "Number of 20 cent coins is: " + coin20;
            coin10Label.Content = "Number of 10 cent coins is: " + coin10;
            coin5Label.Content = "Number of 5 cent coins is: " + coin5;
        }

        private void Button_Click_8(object sender, RoutedEventArgs e)
        {
            double b = Convert.ToDouble(bText.Text);
            double n = Convert.ToDouble(nText.Text);
            double r = Convert.ToDouble(rText.Text);
            double answer = b + (1 + r / 100) * n * n;
            eLabel.Content = "Eindsaldo is: " + answer;
        }

        private void Button_Click_9(object sender, RoutedEventArgs e)
        {
            int value = Convert.ToInt32(BinText.Text);
            string binary = Convert.ToString(value, 2);
            BinairLabel.Content = "Your answer is: " + binary;
        }
    }
}
