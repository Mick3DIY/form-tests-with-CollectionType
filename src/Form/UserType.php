<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $roles = [User::USER_DEFAULT => 'Simple User',
            User::USER_ADMIN_APP => 'App. Admin',
            User::USER_ADMIN_PROJECT => 'Project Admin',
            User::USER_ADMIN => 'Administrator'];
// With multiple choice, its work but with all the choice :(
//        $builder->add('username')
//            ->add('roles', ChoiceType::class, [
//                'label' => 'Roles', 'required' => true,
//                'choices' => array_flip($roles),
//                'multiple' => true, 'expanded' => false
//            ])
        //Try with one listbox WITH only one choice
        $builder->add('username')
            ->add('roles', CollectionType::class, [
                'label' => 'Roles', 'required' => true, 'entry_type' => ChoiceType::class,
                'entry_options' => ['label' => false, 'choices' => array_flip($roles)],])
            ->add('password')
            ->add('email')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
