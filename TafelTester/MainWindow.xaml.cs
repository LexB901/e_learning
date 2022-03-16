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
using System.Text.RegularExpressions;


namespace TafelTester
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
        private new void PreviewTextInput(object sender, TextCompositionEventArgs e)
        {
            Regex regex = new Regex("[^0-9]+");
            e.Handled = regex.IsMatch(e.Text);
        }

        private void EasyQuestionGrid(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
            QuestionEasyGrid.Visibility = Visibility.Visible;
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
        }

        private void EasyQuestion(object sender, RoutedEventArgs e)
        {
            ButtonEasyGrid.Visibility = Visibility.Collapsed;
            AnsCorrect.Visibility = Visibility.Collapsed;
            AnsWrong.Visibility = Visibility.Collapsed;
            QuestionEasy.Visibility = Visibility.Visible;
            Random rnd = new Random();
            int RandomNum1 = rnd.Next(1, 11);
            int RandomNum2 = rnd.Next(1, 11);
            int sum = RandomNum1 + RandomNum2;
            EasyNum1.Content = RandomNum1;
            EasyNum2.Content = RandomNum2;
            int SumAns = Convert.ToInt32(EasyInput);
            if (SumAns == sum)
            {
                AnsCorrect.Visibility = Visibility.Visible;

            }
        }
    }
}
